<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_ConvertJobData extends Kaltura_Client_Type_ConvartableJobData
{
	public function getKalturaObjectType()
	{
		return 'KalturaConvertJobData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->destFileSyncLocalPath = (string)$xml->destFileSyncLocalPath;
		$this->destFileSyncRemoteUrl = (string)$xml->destFileSyncRemoteUrl;
		$this->logFileSyncLocalPath = (string)$xml->logFileSyncLocalPath;
		$this->flavorAssetId = (string)$xml->flavorAssetId;
		$this->remoteMediaId = (string)$xml->remoteMediaId;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $destFileSyncLocalPath = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $destFileSyncRemoteUrl = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $logFileSyncLocalPath = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $flavorAssetId = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $remoteMediaId = null;


}

