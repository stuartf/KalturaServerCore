<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_ExtractMediaJobData extends Kaltura_Client_Type_ConvartableJobData
{
	public function getKalturaObjectType()
	{
		return 'KalturaExtractMediaJobData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->flavorAssetId = (string)$xml->flavorAssetId;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $flavorAssetId = null;


}

