<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_ContentDistribution_Type_DistributionValidationErrorMissingFlavor extends Kaltura_Client_ContentDistribution_Type_DistributionValidationError
{
	public function getKalturaObjectType()
	{
		return 'KalturaDistributionValidationErrorMissingFlavor';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->flavorParamsId = (string)$xml->flavorParamsId;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $flavorParamsId = null;


}

