<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_ContentDistribution_Type_DistributionValidationErrorMissingMetadata extends Kaltura_Client_ContentDistribution_Type_DistributionValidationError
{
	public function getKalturaObjectType()
	{
		return 'KalturaDistributionValidationErrorMissingMetadata';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->fieldName = (string)$xml->fieldName;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $fieldName = null;


}

