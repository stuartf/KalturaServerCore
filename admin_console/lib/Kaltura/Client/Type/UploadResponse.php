<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_UploadResponse extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaUploadResponse';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->uploadTokenId = (string)$xml->uploadTokenId;
		if(count($xml->fileSize))
			$this->fileSize = (int)$xml->fileSize;
		if(count($xml->errorCode))
			$this->errorCode = (int)$xml->errorCode;
		$this->errorDescription = (string)$xml->errorDescription;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $uploadTokenId = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $fileSize = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_UploadErrorCode
	 */
	public $errorCode = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $errorDescription = null;


}

