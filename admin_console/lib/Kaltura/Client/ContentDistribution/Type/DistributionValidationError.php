<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_ContentDistribution_Type_DistributionValidationError extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaDistributionValidationError';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->action))
			$this->action = (int)$xml->action;
		if(count($xml->errorType))
			$this->errorType = (int)$xml->errorType;
		$this->description = (string)$xml->description;
	}
	/**
	 * 
	 *
	 * @var Kaltura_Client_ContentDistribution_Enum_DistributionAction
	 */
	public $action = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_ContentDistribution_Enum_DistributionErrorType
	 */
	public $errorType = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $description = null;


}

