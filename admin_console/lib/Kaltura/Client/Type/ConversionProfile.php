<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_ConversionProfile extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaConversionProfile';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->id))
			$this->id = (int)$xml->id;
		if(count($xml->partnerId))
			$this->partnerId = (int)$xml->partnerId;
		$this->status = (string)$xml->status;
		$this->name = (string)$xml->name;
		$this->systemName = (string)$xml->systemName;
		$this->tags = (string)$xml->tags;
		$this->description = (string)$xml->description;
		$this->defaultEntryId = (string)$xml->defaultEntryId;
		if(count($xml->createdAt))
			$this->createdAt = (int)$xml->createdAt;
		$this->flavorParamsIds = (string)$xml->flavorParamsIds;
		if(count($xml->isDefault))
			$this->isDefault = (int)$xml->isDefault;
		if(!empty($xml->isPartnerDefault))
			$this->isPartnerDefault = true;
		if(!empty($xml->cropDimensions))
			$this->cropDimensions = Kaltura_Client_Client::unmarshalItem($xml->cropDimensions);
		if(count($xml->clipStart))
			$this->clipStart = (int)$xml->clipStart;
		if(count($xml->clipDuration))
			$this->clipDuration = (int)$xml->clipDuration;
		$this->xslTransformation = (string)$xml->xslTransformation;
		if(count($xml->storageProfileId))
			$this->storageProfileId = (int)$xml->storageProfileId;
	}
	/**
	 * The id of the Conversion Profile
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $id = null;

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
	 * @var Kaltura_Client_Enum_ConversionProfileStatus
	 */
	public $status = null;

	/**
	 * The name of the Conversion Profile
	 * 
	 *
	 * @var string
	 */
	public $name = null;

	/**
	 * System name of the Conversion Profile
	 * 
	 *
	 * @var string
	 */
	public $systemName = null;

	/**
	 * Comma separated tags
	 * 
	 *
	 * @var string
	 */
	public $tags = null;

	/**
	 * The description of the Conversion Profile
	 * 
	 *
	 * @var string
	 */
	public $description = null;

	/**
	 * ID of the default entry to be used for template data
	 * 
	 *
	 * @var string
	 */
	public $defaultEntryId = null;

	/**
	 * Creation date as Unix timestamp (In seconds) 
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $createdAt = null;

	/**
	 * List of included flavor ids (comma separated)
	 * 
	 *
	 * @var string
	 */
	public $flavorParamsIds = null;

	/**
	 * Indicates that this conversion profile is system default
	 * 
	 *
	 * @var Kaltura_Client_Enum_NullableBoolean
	 */
	public $isDefault = null;

	/**
	 * Indicates that this conversion profile is partner default
	 * 
	 *
	 * @var bool
	 * @readonly
	 */
	public $isPartnerDefault = null;

	/**
	 * Cropping dimensions
	 * DEPRECATED
	 *
	 * @var Kaltura_Client_Type_CropDimensions
	 */
	public $cropDimensions;

	/**
	 * Clipping start position (in miliseconds)
	 * DEPRECATED
	 *
	 * @var int
	 */
	public $clipStart = null;

	/**
	 * Clipping duration (in miliseconds)
	 * DEPRECATED
	 *
	 * @var int
	 */
	public $clipDuration = null;

	/**
	 * XSL to transform ingestion MRSS XML
	 * 
	 *
	 * @var string
	 */
	public $xslTransformation = null;

	/**
	 * ID of default storage profile to be used for linked net-storage file syncs
	 * 
	 *
	 * @var int
	 */
	public $storageProfileId = null;


}

