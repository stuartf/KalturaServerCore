<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_DropFolder_Type_DropFolderFile extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaDropFolderFile';
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
		if(count($xml->dropFolderId))
			$this->dropFolderId = (int)$xml->dropFolderId;
		$this->fileName = (string)$xml->fileName;
		if(count($xml->fileSize))
			$this->fileSize = (int)$xml->fileSize;
		if(count($xml->fileSizeLastSetAt))
			$this->fileSizeLastSetAt = (int)$xml->fileSizeLastSetAt;
		if(count($xml->status))
			$this->status = (int)$xml->status;
		$this->parsedSlug = (string)$xml->parsedSlug;
		$this->parsedFlavor = (string)$xml->parsedFlavor;
		$this->errorCode = (string)$xml->errorCode;
		$this->errorDescription = (string)$xml->errorDescription;
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
	 * @readonly
	 */
	public $partnerId = null;

	/**
	 * 
	 *
	 * @var int
	 * @insertonly
	 */
	public $dropFolderId = null;

	/**
	 * 
	 *
	 * @var string
	 * @insertonly
	 */
	public $fileName = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $fileSize = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $fileSizeLastSetAt = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_DropFolder_Enum_DropFolderFileStatus
	 */
	public $status = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $parsedSlug = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $parsedFlavor = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_DropFolder_Enum_DropFolderFileErrorCode
	 */
	public $errorCode = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $errorDescription = null;

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

