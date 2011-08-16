<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_ContentDistribution_Type_DistributionValidationErrorMissingThumbnail extends Kaltura_Client_ContentDistribution_Type_DistributionValidationError
{
	public function getKalturaObjectType()
	{
		return 'KalturaDistributionValidationErrorMissingThumbnail';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(!empty($xml->dimensions))
			$this->dimensions = Kaltura_Client_Client::unmarshalItem($xml->dimensions);
	}
	/**
	 * 
	 *
	 * @var Kaltura_Client_ContentDistribution_Type_DistributionThumbDimensions
	 */
	public $dimensions;


}

