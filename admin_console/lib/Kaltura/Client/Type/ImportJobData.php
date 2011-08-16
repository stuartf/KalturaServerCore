<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_ImportJobData extends Kaltura_Client_Type_JobData
{
	public function getKalturaObjectType()
	{
		return 'KalturaImportJobData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->srcFileUrl = (string)$xml->srcFileUrl;
		$this->destFileLocalPath = (string)$xml->destFileLocalPath;
		$this->flavorAssetId = (string)$xml->flavorAssetId;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $srcFileUrl = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $destFileLocalPath = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $flavorAssetId = null;


}

