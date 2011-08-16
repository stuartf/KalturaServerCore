<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_ContentDistribution_Type_DistributionValidationErrorInvalidData extends Kaltura_Client_ContentDistribution_Type_DistributionValidationError
{
	public function getKalturaObjectType()
	{
		return 'KalturaDistributionValidationErrorInvalidData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->fieldName = (string)$xml->fieldName;
		if(count($xml->validationErrorType))
			$this->validationErrorType = (int)$xml->validationErrorType;
		$this->validationErrorParam = (string)$xml->validationErrorParam;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $fieldName = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_ContentDistribution_Enum_DistributionValidationErrorType
	 */
	public $validationErrorType = null;

	/**
	 * Parameter of the validation error
	 * For example, minimum value for KalturaDistributionValidationErrorType::STRING_TOO_SHORT validation error
	 *
	 * @var string
	 */
	public $validationErrorParam = null;


}

