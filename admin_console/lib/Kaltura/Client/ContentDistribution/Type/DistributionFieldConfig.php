<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_ContentDistribution_Type_DistributionFieldConfig extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaDistributionFieldConfig';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->fieldName = (string)$xml->fieldName;
		$this->userFriendlyFieldName = (string)$xml->userFriendlyFieldName;
		$this->entryMrssXslt = (string)$xml->entryMrssXslt;
		if(count($xml->isRequired))
			$this->isRequired = (int)$xml->isRequired;
		if(!empty($xml->updateOnChange))
			$this->updateOnChange = true;
		if(empty($xml->updateParams))
			$this->updateParams = array();
		else
			$this->updateParams = Kaltura_Client_Client::unmarshalItem($xml->updateParams);
		if(!empty($xml->isDefault))
			$this->isDefault = true;
	}
	/**
	 * A value taken from a connector field enum which associates the current configuration to that connector field
	 * Field enum class should be returned by the provider's getFieldEnumClass function.
	 *
	 * @var string
	 */
	public $fieldName = null;

	/**
	 * A string that will be shown to the user as the field name in error messages related to the current field
	 *
	 * @var string
	 */
	public $userFriendlyFieldName = null;

	/**
	 * An XSLT string that extracts the right value from the Kaltura entry MRSS XML.
	 * The value of the current connector field will be the one that is returned from transforming the Kaltura entry MRSS XML using this XSLT string.
	 *
	 * @var string
	 */
	public $entryMrssXslt = null;

	/**
	 * Is the field required to have a value for submission ?
	 *
	 * @var Kaltura_Client_ContentDistribution_Enum_DistributionFieldRequiredStatus
	 */
	public $isRequired = null;

	/**
	 * Trigger distribution update when this field changes or not ?
	 *
	 * @var bool
	 */
	public $updateOnChange = null;

	/**
	 * Entry column or metadata xpath that should trigger an update
	 * TODO: find a better solution for this
	 *
	 * @var array of KalturaString
	 */
	public $updateParams;

	/**
	 * Is this field config is the default for the distribution provider?
	 *
	 * @var bool
	 * @readonly
	 */
	public $isDefault = null;


}

