<?php
class Kaltura_Client_Type_DropFolder extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaDropFolder';
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
		$this->description = (string)$xml->description;
		$this->type = (string)$xml->type;
		if(count($xml->status))
			$this->status = (int)$xml->status;
		if(count($xml->conversionProfileId))
			$this->conversionProfileId = (int)$xml->conversionProfileId;
		if(count($xml->dc))
			$this->dc = (int)$xml->dc;
		$this->path = (string)$xml->path;
		if(count($xml->fileSizeCheckInterval))
			$this->fileSizeCheckInterval = (int)$xml->fileSizeCheckInterval;
		if(count($xml->fileDeletePolicy))
			$this->fileDeletePolicy = (int)$xml->fileDeletePolicy;
		if(count($xml->autoFileDeleteDays))
			$this->autoFileDeleteDays = (int)$xml->autoFileDeleteDays;
		$this->fileHandlerType = (string)$xml->fileHandlerType;
		$this->fileNamePatterns = (string)$xml->fileNamePatterns;
		if(!empty($xml->fileHandlerConfig))
			$this->fileHandlerConfig = Kaltura_Client_Client::unmarshalItem($xml->fileHandlerConfig);
		$this->tags = (string)$xml->tags;
		$this->ignoreFileNamePatterns = (string)$xml->ignoreFileNamePatterns;
		if(count($xml->createdAt))
			$this->createdAt = (int)$xml->createdAt;
		if(count($xml->updatedAt))
			$this->updatedAt = (int)$xml->updatedAt;
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
	 * @insertonly
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
	public $description = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_DropFolderType
	 */
	public $type = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_DropFolderStatus
	 */
	public $status = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $conversionProfileId = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $dc = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $path = null;

	/**
	 * The ammount of time, in seconds, that should pass so that a file with no change in size we'll be treated as "finished uploading to folder"
	 *
	 * @var int
	 */
	public $fileSizeCheckInterval = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_DropFolderFileDeletePolicy
	 */
	public $fileDeletePolicy = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $autoFileDeleteDays = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_DropFolderFileHandlerType
	 */
	public $fileHandlerType = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $fileNamePatterns = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_DropFolder_Type_DropFolderFileHandlerConfig
	 */
	public $fileHandlerConfig;

	/**
	 * 
	 *
	 * @var string
	 */
	public $tags = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $ignoreFileNamePatterns = null;

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


}

