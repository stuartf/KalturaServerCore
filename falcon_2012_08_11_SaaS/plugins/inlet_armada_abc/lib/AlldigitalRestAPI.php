<?php
/**
 * 
 * @package Scheduler
 * @subpackage Conversion
 * 
 * API wrapper for the Alldigital Rest API.
 *
 */

 class AlldigitalAPIStatus {
	const NOT_STARTED = 0;
	const RUNNING = 1;
	const FINISHED = 2;
	const FAILED = 3;
	const DELETED = 4;
};

class AlldigitalRestAPI
{
	/**
	 * @var string
	 */
	private $url;

	/**
	 * @var array
	 */
	private $creds = array(
		"user" => null,
		"pass" => null,
	);

	protected $functions = array("aaa"=>"AAA");
	
	/**
	 * @param unknown_type $u
	 */
	public function setUrl($u)
	{
		$this->url = $u;
	}
	
	protected function getUrl($u)
	{
		return $this->url.$u;
	}
	
	/**
	 * @param unknown_type $u
	 */
	public function setUser($u)
	{
		$this->creds['user'] = $u;
	}
	
	/**
	 * @param unknown_type $p
	 */
	public function setPassw($p)
	{
		$this->creds['pass'] = $p;
	}
	
	/**
	 * @param unknown_type $url
	 * @param array $params
	 * @param unknown_type $err
	 * @return Ambigous <NULL, mixed>
	 */
	protected function sendRequest($url, array $params=null, &$err)
	{
		KalturaLog::info("url($url),params(".print_r($params,1).")");

		$fields = array_merge($this->creds,(array)$params);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		$result = curl_exec($ch);

$errStr=null;
		$rvXml=null;
		if(isset($result)) {
			try {
				$rvXml = new SimpleXMLElement($result);

				if(isset($rvXml)) {
				 	if(isset($rvXml->error)){
						$err = (string)$rvXml->error;
						$result = null;
						$errStr = "error($err)";
				 	}
				 	else if(isset($rvXml->result) && isset($rvXml->result->id) && $rvXml->result->id==0){
						$err = "msg:".(string)$rvXml->result->message.",id:".(string)$rvXml->result->id;
						$result = null;
						$errStr = "error($err)";
				 	}
				 	else {
						$result=$rvXml;
				 	}
				}
			}
			catch (Exception $e){
				$err = print_r($e,1);
				$errStr = "exception($err),result($result)";
				$result = null;
			}
		}
		else {
			$err = curl_error($ch);
			$errStr = "error($err)";
		}
		
		curl_close($ch);

		if(isset($errStr))
			KalturaLog::info("request failed - $errStr");

		return $result;
	}
}

class ADWorkflowAPI extends AlldigitalRestAPI
{
	/**
	 * @var array
	 */
	protected $functions = array(
		'Create' => '/workflow/create/format/xml',
		'Delete' => '/workflow/delete/format/xml',
		'Status' => '/workflow/status/format/xml',
		'ListJobs' => '/workflow/list/format/xml',
	);

	/**
	 * @param unknown_type $input_file
	 * @param unknown_type $output_dir
	 * @param unknown_type $template_id
	 * @param unknown_type $priority
	 * @param unknown_type $cdn_id
	 * @param unknown_type $err
	 * @return NULL
	 */
	public function Create($description, $input_file, $output_file, $encode_template, $package_template, $deliver_template, $priority, &$err)
	{
		$params['description'] = $description;
		$params['input_file'] = $input_file;
		$params['output_file'] = $output_file;
		$params['encode_template'] = $encode_template;
		$params['package_template'] = "$package_template";
		$params['deliver_template'] = "$deliver_template";
		$params['priority'] = $priority;
		$params['callback_url']= "";
		$params['encode_callback_url']= "";
		$params['package_callback_url']= "";
		$params['deliver_callback_url']= "";
		$url = $this->getUrl($this->functions[__FUNCTION__]);
		
		$rvXml = self::sendRequest($url, $params, $err);
		if(!isset($rvXml) || !$rvXml->data->key){
			return null;
		}
		return (string)$rvXml->data->key;
	}

	/**
	 * @param unknown_type $job_id
	 * @param unknown_type $err
	 * @return NULL|string
	 */
	public function Delete($key, &$err)
	{
		$params['key'] = $key;
		$params['purge_mode'] = 0;
		$url = $this->getUrl($this->functions[__FUNCTION__]);
				
		return self::sendRequest($url, $params, $err);
	}

	/**
	 * @param unknown_type $job_id
	 * @param unknown_type $err
	 * @return NULL|unknown
	 */
	public function Status($key, &$err)
	{
		$params['key'] = $key;
		$url = $this->getUrl($this->functions[__FUNCTION__]);
				
		return self::sendRequest($url, $params, $err);
	}

	/**
	 * @param unknown_type $err
	 * @return NULL|unknown
	 */
	public function ListJobs(&$err)
	{
		$url = $this->getUrl($this->functions[__FUNCTION__]);
		return self::sendRequest($url, null, $err);
	}
}

class ADContentAPI extends AlldigitalRestAPI
{
	/**
	 * @var array
	 */
	protected $functions = array(
		'ListContent' => '/content/list/format/xml',
		'MediaInfo' => 	'/content/mediainfo/format/xml',
	);

	/**
	 * @param unknown_type $location
	 * @param unknown_type $err
	 */
	public function ListContent($location, &$err)
	{
		$params['location'] = $location;
		$url = $this->getUrl($this->functions[__FUNCTION__]);
		return self::sendRequest($url, $params, $err);
	}

	/**
	 * @param unknown_type $file_name
	 * @param unknown_type $err
	 * @return NULL|unknown
	 */
	public function MediaInfo($location, $file_name, &$err)
	{
		$params['location'] = $location;
		$params['file_name'] = $file_name;
		$url = $this->getUrl($this->functions[__FUNCTION__]);
		return self::sendRequest($url, $params, $err);
	}

	/**
	 * @param unknown_type $location
	 * @param unknown_type $file_name
	 * @param unknown_type $err
	 * @return unknown
	 */
	public function MediaInfoToText($location, $file_name, &$err)
	{
		$rv=$this->MediaInfo($location, $file_name, $err);
		if(isset($rv)) {
			$mi = (string)$rv->data->mediainfo;
			$str=base64_decode($mi);
			return $str;
		}
		return $rv;
	}
}

class KMediaInfoMediaParserString extends KMediaInfoMediaParser 
{
	/**
	 * @var string
	 */
	protected $mediaInfoStr;
	
	public function __construct($mediaInfoStr) {
		$this->mediaInfoStr = $mediaInfoStr;
	}
	public function getRawMediaInfo(){
		return $this->mediaInfoStr;
	}
}


