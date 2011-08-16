<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_ContentDistribution_Type_GenericDistributionProvider extends Kaltura_Client_ContentDistribution_Type_DistributionProvider
{
	public function getKalturaObjectType()
	{
		return 'KalturaGenericDistributionProvider';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->id))
			$this->id = (int)$xml->id;
		if(count($xml->createdAt))
			$this->createdAt = (int)$xml->createdAt;
		if(count($xml->updatedAt))
			$this->updatedAt = (int)$xml->updatedAt;
		if(count($xml->partnerId))
			$this->partnerId = (int)$xml->partnerId;
		if(!empty($xml->isDefault))
			$this->isDefault = true;
		if(count($xml->status))
			$this->status = (int)$xml->status;
		$this->optionalFlavorParamsIds = (string)$xml->optionalFlavorParamsIds;
		$this->requiredFlavorParamsIds = (string)$xml->requiredFlavorParamsIds;
		if(empty($xml->optionalThumbDimensions))
			$this->optionalThumbDimensions = array();
		else
			$this->optionalThumbDimensions = Kaltura_Client_Client::unmarshalItem($xml->optionalThumbDimensions);
		if(empty($xml->requiredThumbDimensions))
			$this->requiredThumbDimensions = array();
		else
			$this->requiredThumbDimensions = Kaltura_Client_Client::unmarshalItem($xml->requiredThumbDimensions);
		$this->editableFields = (string)$xml->editableFields;
		$this->mandatoryFields = (string)$xml->mandatoryFields;
	}
	/**
	 * Auto generated
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $id = null;

	/**
	 * Generic distribution provider creation date as Unix timestamp (In seconds)
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $createdAt = null;

	/**
	 * Generic distribution provider last update date as Unix timestamp (In seconds)
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $updatedAt = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $partnerId = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	public $isDefault = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_ContentDistribution_Enum_GenericDistributionProviderStatus
	 * @readonly
	 */
	public $status = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $optionalFlavorParamsIds = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $requiredFlavorParamsIds = null;

	/**
	 * 
	 *
	 * @var array of KalturaDistributionThumbDimensions
	 */
	public $optionalThumbDimensions;

	/**
	 * 
	 *
	 * @var array of KalturaDistributionThumbDimensions
	 */
	public $requiredThumbDimensions;

	/**
	 * 
	 *
	 * @var string
	 */
	public $editableFields = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $mandatoryFields = null;


}

