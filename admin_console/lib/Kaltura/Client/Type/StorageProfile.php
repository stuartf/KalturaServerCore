<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_StorageProfile extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaStorageProfile';
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
		$this->name = (string)$xml->name;
		$this->systemName = (string)$xml->systemName;
		$this->desciption = (string)$xml->desciption;
		if(count($xml->status))
			$this->status = (int)$xml->status;
		if(count($xml->protocol))
			$this->protocol = (int)$xml->protocol;
		$this->storageUrl = (string)$xml->storageUrl;
		$this->storageBaseDir = (string)$xml->storageBaseDir;
		$this->storageUsername = (string)$xml->storageUsername;
		$this->storagePassword = (string)$xml->storagePassword;
		if(!empty($xml->storageFtpPassiveMode))
			$this->storageFtpPassiveMode = true;
		$this->deliveryHttpBaseUrl = (string)$xml->deliveryHttpBaseUrl;
		$this->deliveryRmpBaseUrl = (string)$xml->deliveryRmpBaseUrl;
		$this->deliveryIisBaseUrl = (string)$xml->deliveryIisBaseUrl;
		if(count($xml->minFileSize))
			$this->minFileSize = (int)$xml->minFileSize;
		if(count($xml->maxFileSize))
			$this->maxFileSize = (int)$xml->maxFileSize;
		$this->flavorParamsIds = (string)$xml->flavorParamsIds;
		if(count($xml->maxConcurrentConnections))
			$this->maxConcurrentConnections = (int)$xml->maxConcurrentConnections;
		$this->pathManagerClass = (string)$xml->pathManagerClass;
		$this->urlManagerClass = (string)$xml->urlManagerClass;
		if(count($xml->trigger))
			$this->trigger = (int)$xml->trigger;
	}
	/**
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
	public $createdAt = null;

	/**
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
	 * @var string
	 */
	public $name = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $systemName = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $desciption = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_StorageProfileStatus
	 */
	public $status = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_StorageProfileProtocol
	 */
	public $protocol = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $storageUrl = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $storageBaseDir = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $storageUsername = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $storagePassword = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	public $storageFtpPassiveMode = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $deliveryHttpBaseUrl = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $deliveryRmpBaseUrl = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $deliveryIisBaseUrl = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $minFileSize = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $maxFileSize = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $flavorParamsIds = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $maxConcurrentConnections = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $pathManagerClass = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $urlManagerClass = null;

	/**
	 * No need to create enum for temp field
	 * 
	 *
	 * @var int
	 */
	public $trigger = null;


}

