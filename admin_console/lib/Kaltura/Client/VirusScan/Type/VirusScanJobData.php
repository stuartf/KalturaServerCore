<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_VirusScan_Type_VirusScanJobData extends Kaltura_Client_Type_JobData
{
	public function getKalturaObjectType()
	{
		return 'KalturaVirusScanJobData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->srcFilePath = (string)$xml->srcFilePath;
		$this->flavorAssetId = (string)$xml->flavorAssetId;
		if(count($xml->scanResult))
			$this->scanResult = (int)$xml->scanResult;
		if(count($xml->virusFoundAction))
			$this->virusFoundAction = (int)$xml->virusFoundAction;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $srcFilePath = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $flavorAssetId = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_VirusScan_Enum_VirusScanJobResult
	 */
	public $scanResult = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_VirusScan_Enum_VirusFoundAction
	 */
	public $virusFoundAction = null;


}

