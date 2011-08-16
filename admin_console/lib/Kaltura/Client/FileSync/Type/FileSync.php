<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_FileSync_Type_FileSync extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaFileSync';
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
		$this->fileObjectType = (string)$xml->fileObjectType;
		$this->objectId = (string)$xml->objectId;
		$this->version = (string)$xml->version;
		if(count($xml->objectSubType))
			$this->objectSubType = (int)$xml->objectSubType;
		$this->dc = (string)$xml->dc;
		if(count($xml->original))
			$this->original = (int)$xml->original;
		if(count($xml->createdAt))
			$this->createdAt = (int)$xml->createdAt;
		if(count($xml->updatedAt))
			$this->updatedAt = (int)$xml->updatedAt;
		if(count($xml->readyAt))
			$this->readyAt = (int)$xml->readyAt;
		if(count($xml->syncTime))
			$this->syncTime = (int)$xml->syncTime;
		if(count($xml->status))
			$this->status = (int)$xml->status;
		if(count($xml->fileType))
			$this->fileType = (int)$xml->fileType;
		if(count($xml->linkedId))
			$this->linkedId = (int)$xml->linkedId;
		if(count($xml->linkCount))
			$this->linkCount = (int)$xml->linkCount;
		$this->fileRoot = (string)$xml->fileRoot;
		$this->filePath = (string)$xml->filePath;
		if(count($xml->fileSize))
			$this->fileSize = (int)$xml->fileSize;
		$this->fileUrl = (string)$xml->fileUrl;
		$this->fileContent = (string)$xml->fileContent;
		if(count($xml->fileDiscSize))
			$this->fileDiscSize = (int)$xml->fileDiscSize;
		if(!empty($xml->isCurrentDc))
			$this->isCurrentDc = true;
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
	public $partnerId = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_FileSyncObjectType
	 * @readonly
	 */
	public $fileObjectType = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $objectId = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $version = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $objectSubType = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $dc = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $original = null;

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
	public $readyAt = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $syncTime = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_FileSync_Enum_FileSyncStatus
	 * @readonly
	 */
	public $status = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_FileSync_Enum_FileSyncType
	 * @readonly
	 */
	public $fileType = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $linkedId = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $linkCount = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $fileRoot = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $filePath = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $fileSize = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $fileUrl = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $fileContent = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $fileDiscSize = null;

	/**
	 * 
	 *
	 * @var bool
	 * @readonly
	 */
	public $isCurrentDc = null;


}

