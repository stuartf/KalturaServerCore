<?php
/**
 * @package plugins.uplynk
 * @subpackage storage
 */
class kUplynkUrlManager extends kUrlManager
{
    const DEFAULT_EXPIRY_WINDOW_SECONDS = 120; // 120 seconds = 2 minutes
    const EID_METADATA_PROFILE_ID = '6012';
    const EID_METADATA_FIELD_KEY = 'VWID';
    const ASSET_TYPE_METADATA_FIELD_KEY = 'MediaSubtype';
    
	/**
	 * @return kUrlTokenizer
	 */
	public function getTokenizer()
	{
		list($expiryWindow, $apiKey, $accountId) = $this->getUplynkAccountParams();
		
		$workFlowId = $this->getWorkFlowId();
		$assetType = $this->getCustomMetadataValue(self::ASSET_TYPE_METADATA_FIELD_KEY);
		
		$baseUrl = '';
		if ($this->storageProfileId) {
		    $storageProfile = StorageProfilePeer::retrieveByPK($this->storageProfileId);
		    if ($storageProfile)
		    {
    		    if ($this->protocol == StorageProfile::PLAY_FORMAT_HTTP) {
    		        $baseUrl = $storageProfile->getDeliveryHttpBaseUrl();
    		    }
    		    else if ($this->protocol == StorageProfile::PLAY_FORMAT_RTMP) {
    		        $baseUrl = rtrim($storageProfile->getRTMPPrefix(),'/').'/'.ltrim($storageProfile->getDeliveryRmpBaseUrl,'/');
    		    }
		    }
		}
		
		return new kUplynkUrlTokenizer(
			$expiryWindow,
			$apiKey,
			$accountId,
			$workFlowId,
			$assetType,
			$baseUrl
		);
	}
	
	/**
	 * Finalize URLs
	 * @param string baseUrl
	 * @param array $flavorUrls
	 */
	public function finalizeUrls(&$baseUrl, &$flavorsUrls)
	{
		if (!count($flavorsUrls))
		{
			return;
		}
		
		// concat baseUrl to all flavor Urls
		$baseUrl = rtrim($baseUrl,'/');
		foreach($flavorsUrls as &$flavor)
		{			    
		    $flavor["url"] = $baseUrl . '/' . ltrim($flavor["url"],'/');
		}
		
		// empty baseUrl so it will not be sent in the manifest
		$baseUrl = '';
	}
	
	
    /**
     * @return uplynk account parameters from the url parameters array
     */
	protected function getUplynkAccountParams()
	{
	    $expiryWindow = null;
	    $apiKey = null;
	    $accountId = null;
	     
	    if ($this->protocol == StorageProfile::PLAY_FORMAT_HTTP )
		{
		    $expiryWindow = isset($this->params['http_auth_window'])     ? $this->params['http_auth_window']     : self::DEFAULT_EXPIRY_WINDOW_SECONDS;
		    $apiKey       = isset($this->params['http_auth_api_key'])    ? $this->params['http_auth_api_key']    : null;
		    $accountId    = isset($this->params['http_auth_account_id']) ? $this->params['http_auth_account_id'] : null;    	
		}
	    else if ($this->protocol == StorageProfile::PLAY_FORMAT_RTMP )
		{
		    $expiryWindow = isset($this->params['rtmp_auth_window'])     ? $this->params['rtmp_auth_window']     : self::DEFAULT_EXPIRY_WINDOW_SECONDS;
		    $apiKey       = isset($this->params['rtmp_auth_api_key'])    ? $this->params['rtmp_auth_api_key']    : null;
		    $accountId    = isset($this->params['rtmp_auth_account_id']) ? $this->params['rtmp_auth_account_id'] : null;    	
		}
		
		return array($expiryWindow, $apiKey, $accountId);
	}
	
	
	/**
	 * @return string from the related entry's referenceId field
	 */
	protected function getCustomMetadataValue($fieldKey)
	{
	    $entry = entryPeer::retrieveByPK($this->entryId);
	    if (!$entry) {
	        // error - missing entry
	        KalturaLog::err('Missing entry');
	        return null;
	    }
	    
	    $metadata = MetadataPeer::retrieveByObject(self::EID_METADATA_PROFILE_ID, MetadataObjectType::ENTRY, $entry->getId());
	    if (!$metadata) {
	        KalturaLog::err('Missing metadata');
	        return null;
	    }
	    $metadataSyncKey = $metadata->getSyncKey(metadata::FILE_SYNC_METADATA_DATA);
		$metadataXml = kFileSyncUtils::file_get_contents($metadataSyncKey, true, false);
		
		$metadataXmlObj = new SimpleXMLElement($metadataXml);
		if (!isset($metadataXmlObj->{$fieldKey})) {
		    KalturaLog::err('Missing metadata value for field ['.$fieldKey.']');
	        return null;
		}
	    
	    $value = $metadataXmlObj->{$fieldKey};
	    $value = (string)$value; // cast to string to return a value instead of simplexml element
	    
	    return $value;
	}
	
	/**
	 * @return string workFlowId from the related entry's referenceId field
	 */
	protected function getWorkFlowId()
	{
	    $workFlowId = $this->getCustomMetadataValue(self::EID_METADATA_FIELD_KEY);
	    $workFlowId = preg_replace('/^.+_/', '', $workFlowId);
	    return $workFlowId;
	}
}
