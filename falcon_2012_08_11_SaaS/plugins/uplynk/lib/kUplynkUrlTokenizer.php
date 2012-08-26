<?php
/**
 * @package plugins.uplynk
 * @subpackage storage
 */
class kUplynkUrlTokenizer extends kUrlTokenizer
{
    // different values used by the tokenizer 
    const DEVICE_NON_IOS_VALUE = '001';
    const APPLICATION_KEY_IOS_DEVICE = 'ios_1';
    const CONTENT_TYPE_LINEAR_CHANNEL = 'c';
    const CONTENT_TYPE_ASSET = 'a';
    const ASSET_URL_FITS_OID_EID = '/ext/';
    const ASSET_TYPE_VOD_VALUES = 'Full Episode,Multi-Part Episode,Episode Segment,Short Clip,Podcast,Movie';
    const ASSET_TYPE_LIVE_VALUES = 'Live';
    
    // available error messages
    const ERROR_MISSING_PARAM_ACCOUNT_ID = 'ERROR_MISSING_PARAM_ACCOUNT_ID';
    const ERROR_MISSING_PARAM_API_KEY = 'ERROR_MISSING_PARAM_API_KEY';
    const ERROR_MISSING_PARAM_CT = 'ERROR_MISSING_PARAM_CT';
    const ERROR_MISSING_PARAM_EID = 'ERROR_MISSING_PARAM_EID';
       
		
	// account parameters
	public $expiryWindow = null;
	public $apiKey = null;
	public $accountId = null;
	
	// entry parameters
	public $workFlowId = null;
	public $assetType = null;
	
	// other
	public $baseUrl = null;
	
	/**
	 * @param int $expiryWindow
	 * @param string $apiKey
	 * @param string $accountId
	 * @param string $workFlowId
	 */
	public function __construct($expiryWindow, $apiKey, $accountId, $workFlowId, $assetType, $baseUrl)
	{
		$this->expiryWindow = $expiryWindow;
		$this->apiKey = $apiKey;
		$this->accountId = $accountId;
		$this->workFlowId = $workFlowId;
		$this->assetType = $assetType;
		$this->baseUrl = $baseUrl;
	}
	 
	/**
	 * @param string $url
	 * @return string
	 */
	public function tokenizeSingleUrl($url)
	{
		// verify required parameters
		if (strlen($this->accountId) <= 0) {
		    // error - no account id
		    return $this->returnError($url, self::ERROR_MISSING_PARAM_ACCOUNT_ID);
		}
	    if (strlen($this->apiKey) <= 0) {
		    // error - no api key
		    return $this->returnError($url, self::ERROR_MISSING_PARAM_API_KEY);
		}
	
		if (strlen($this->workFlowId) <= 0) {
		    // error - missing eid param
		    return $this->returnError($url, self::ERROR_MISSING_PARAM_EID);
		}	
	
		// get playback cotext params (parameters passed by the player
		$playbackParams = $this->getPlaybackParamsArrays();
		
		$device = isset($playbackParams['device']) ? $playbackParams['device'] : null;
		$isIosDevice = ($device == self::DEVICE_NON_IOS_VALUE) ? false : true;
		
		// get query string parameters
		$tempBaseUrl = rtrim($this->baseUrl,'/').'/'.ltrim($url,'/');
		$error = '';
		$queryParams = $this->getQueryStringParams($playbackParams, $isIosDevice, $tempBaseUrl, $error);
		if (!$queryParams && strlen($error) > 0) {
		    return $this->returnError($url, $error);
		} 
			
		// build query string
        $queryString = $this->getQueryString($queryParams);
		
		// generate hash key
		$hashedQuery = hash_hmac('sha256', $queryString, $this->apiKey);
		$queryString .= '&sig='.$hashedQuery;
		
		// decide about file extension according to device		
		$fileExtension = $isIosDevice ? 'json' : 'm3u8';
		
		// add extension and query string to the final url
		$url .= '.'.$fileExtension .'?'. $queryString;		     
				
		return $url;
	}
		
    /**
     * 
     * @return an array of parameters sent by the player organized for uplyink
     */
	protected function getPlaybackParamsArrays()
	{
	    $playbackContext = urldecode($this->getPlaybackContext());
	    $playbackContext = trim($playbackContext, '&=');
	    $playbackContext = explode('&', $playbackContext);
	    
		$playbackParams = array();
		
		foreach ($playbackContext as $keyValue)
		{
		    $keyEnd = strpos($keyValue, '=');
		    if ($keyEnd !== false) {
		        $key   = substr($keyValue, 0, $keyEnd);
		        $value = substr($keyValue, $keyEnd+1);
		        
		        if (strpos($key, 'ad.') === 0) {
		            $playbackParams['adParams'][$key] = $value;  
		        }
		        else if (strpos($key, 'cb.') === 0) {
		            $playbackParams['cbParams'][$key] = $value;  
		        }
		        else {
		            $playbackParams[$key] = $value;
		        }
		    }
		}
		
		return $playbackParams;
	}
	
	
	/**
	 * @return an array of parameters to use for the uplyink query string
	 * @param array $playbackParams
	 * @param boolean $isIosDevice
	 */
	protected function getQueryStringParams($playbackParams, $isIosDevice, $baseUrl, &$error)
	{
	    $queryParams = array();
	    
	    // add expiry window
		$queryParams['exp'] = time() + $this->expiryWindow; // token expiry time - calculated
		
		// determine content type
		$contentTypeLive = false;
		if (in_array($this->assetType, explode(',', self::ASSET_TYPE_VOD_VALUES))) {
		    $queryParams['ct'] = self::CONTENT_TYPE_ASSET;
		}
		else if (in_array($this->assetType, explode(',', self::ASSET_TYPE_LIVE_VALUES))) {
		    $contentTypeLive = true;
		    $queryParams['ct'] = self::CONTENT_TYPE_LINEAR_CHANNEL;
		}
		else {
		    // error - missing ct param
		    $error = self::ERROR_MISSING_PARAM_CT;
		    return null;
		}
		
		// get content ids
		if (strstr($baseUrl, self::ASSET_URL_FITS_OID_EID) !== false)
		{
		    $queryParams['eid'] = $this->workFlowId; // external id
		    $queryParams['oid'] = $this->accountId; // account id
		}		
		else
		{
		     $queryParams['cid'] = $this->workFlowId; // external id
		}
		
		// calculate user ip
		$userIp = isset($playbackParams['iph']) ? $playbackParams['iph'] : self::getRemoteAddress();
		$queryParams['iph'] = hash('sha256', $userIp); // user's ip address hashed by sha256
		
		// assemble application key
		if ($isIosDevice && !$contentTypeLive)
		{
	        $queryParams['ak']  = self::APPLICATION_KEY_IOS_DEVICE; // application key
		}
		
		// add optional query string parameters
						
		if (isset($playbackParams['rays'])) {
		    $queryParams['rays'] = $playbackParams['rays']; // rays bitrate restriction
		}		
		
		$userId = isset($playbackParams['euid']) ? $playbackParams['euid'] : null;
	    if (!is_null($userId)) {
	        $queryParams['euid'] = $userId; // external user id
		}
		
	    if (isset($playbackParams['delay']) && $contentTypeLive) {
	        $queryParams['delay'] = $playbackParams['delay']; // time delay 
		}
		
	    if (isset($playbackParams['ad'])) {
	        $queryParams['ad'] = $playbackParams['ad']; // ad server definition name 
			if (isset($playbackParams['adParams']))
			{
				foreach ($playbackParams['adParams'] as $adKey => $adValue)
				{
					$queryParams[$adKey] = $adValue;
				}
			}
		}
		
	    if (isset($playbackParams['cb'])) {
	        $queryParams['cb'] = $playbackParams['cb']; // call-back parameter 
			if (isset($playbackParams['cbParams']))
			{
				foreach ($playbackParams['cbParams'] as $cbKey => $cbValue)
				{
					$queryParams[$cbKey] = $cbValue;
				}
			}
		}
	    
	    return $queryParams;
	}
	
	
	/**
	 * @return the given parameters as a query string
	 * @param array $queryParams
	 */
	protected function getQueryString($queryParams)
	{
	    $queryString = '';
		foreach ($queryParams as $key => $value)
		{
		    $queryString .= '&'.$key.'='.$value;
		}
		$queryString = trim($queryString, '&');
		return $queryString;
	}
	
    protected function returnError($url, $error)
    {
        return $url.'?error='.$error;
    }
    
    
	protected static function getRemoteAddress()
	{
	    $remoteAddr = null;
	    
		// support passing ip when proxying
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
		{
			// pick the first ip (client ip)
			$headerIPs = trim($_SERVER['HTTP_X_FORWARDED_FOR'], ',');
		 	$headerIPs = explode(',', $headerIPs);
		 	foreach ($headerIPs as $ip)
		 	{
		 	    preg_match("/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/", trim($ip), $matches); // ignore any string after the ip address
		 	    if (isset($matches[0])) {
		 	        $tempAddr = trim($matches[0]);
		 	        if (!self::isIpPrivate($tempAddr)) { // verify that ip is not from a private range
		 	            $remoteAddr = $tempAddr;
		 	            break;
		 	        }
		 	    }		 	    
		 	}			
		}
		
		// get normal remote address
		if (!$remoteAddr) {
			$remoteAddr = $_SERVER['REMOTE_ADDR'];
		}
		
		return $remoteAddr;		
	}
	
	
	protected static function isIpPrivate($ip)
	{
	    $privateRanges = array(
            '10.0.0.0|10.255.255.255',
            '172.16.0.0|172.31.255.255',
            '192.168.0.0|192.168.255.255',
            '169.254.0.0|169.254.255.255',
            '127.0.0.0|127.255.255.255',
	    );
	    
	    $longIp = ip2long($ip);
	    if ($longIp && $longIp != -1)
	    {
	        foreach ($privateRanges as $range)
	        {
	            list($start, $end) = explode('|', $range);
	            if ($longIp >= ip2long($start) && $longIp <= ip2long($end)) {
	                return true;
	            }
	        }
	    }
        
	    return false;
	}
}
