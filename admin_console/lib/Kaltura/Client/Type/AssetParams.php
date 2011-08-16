<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_AssetParams extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaAssetParams';
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
		$this->name = (string)$xml->name;
		$this->systemName = (string)$xml->systemName;
		$this->description = (string)$xml->description;
		if(count($xml->createdAt))
			$this->createdAt = (int)$xml->createdAt;
		if(count($xml->isSystemDefault))
			$this->isSystemDefault = (int)$xml->isSystemDefault;
		$this->tags = (string)$xml->tags;
		$this->format = (string)$xml->format;
		if(empty($xml->requiredPermissions))
			$this->requiredPermissions = array();
		else
			$this->requiredPermissions = Kaltura_Client_Client::unmarshalItem($xml->requiredPermissions);
	}
	/**
	 * The id of the Flavor Params
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
	 * The name of the Flavor Params
	 * 
	 *
	 * @var string
	 */
	public $name = null;

	/**
	 * System name of the Flavor Params
	 * 
	 *
	 * @var string
	 */
	public $systemName = null;

	/**
	 * The description of the Flavor Params
	 * 
	 *
	 * @var string
	 */
	public $description = null;

	/**
	 * Creation date as Unix timestamp (In seconds)
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $createdAt = null;

	/**
	 * True if those Flavor Params are part of system defaults
	 * 
	 *
	 * @var Kaltura_Client_Enum_NullableBoolean
	 * @readonly
	 */
	public $isSystemDefault = null;

	/**
	 * The Flavor Params tags are used to identify the flavor for different usage (e.g. web, hd, mobile)
	 * 
	 *
	 * @var string
	 */
	public $tags = null;

	/**
	 * The container format of the Flavor Params
	 * 
	 *
	 * @var Kaltura_Client_Enum_ContainerFormat
	 */
	public $format = null;

	/**
	 * Array of partner permisison names that required for using this asset params
	 * 
	 *
	 * @var array of KalturaString
	 */
	public $requiredPermissions;


}

