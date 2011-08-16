<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_FreewheelDistribution_Type_FreewheelDistributionJobProviderData extends Kaltura_Client_ContentDistribution_Type_DistributionJobProviderData
{
	public function getKalturaObjectType()
	{
		return 'KalturaFreewheelDistributionJobProviderData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(empty($xml->videoAssetFilePaths))
			$this->videoAssetFilePaths = array();
		else
			$this->videoAssetFilePaths = Kaltura_Client_Client::unmarshalItem($xml->videoAssetFilePaths);
		$this->thumbAssetFilePath = (string)$xml->thumbAssetFilePath;
	}
	/**
	 * Demonstrate passing array of paths to the job
	 * 
	 *
	 * @var array of KalturaFreewheelDistributionAssetPath
	 */
	public $videoAssetFilePaths;

	/**
	 * Demonstrate passing single path to the job
	 * 
	 *
	 * @var string
	 */
	public $thumbAssetFilePath = null;


}

