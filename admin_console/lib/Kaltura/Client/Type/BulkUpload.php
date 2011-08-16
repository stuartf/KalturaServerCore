<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_BulkUpload extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaBulkUpload';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->id))
			$this->id = (int)$xml->id;
		$this->uploadedBy = (string)$xml->uploadedBy;
		$this->uploadedByUserId = (string)$xml->uploadedByUserId;
		if(count($xml->uploadedOn))
			$this->uploadedOn = (int)$xml->uploadedOn;
		if(count($xml->numOfEntries))
			$this->numOfEntries = (int)$xml->numOfEntries;
		if(count($xml->status))
			$this->status = (int)$xml->status;
		$this->logFileUrl = (string)$xml->logFileUrl;
		$this->csvFileUrl = (string)$xml->csvFileUrl;
		$this->bulkFileUrl = (string)$xml->bulkFileUrl;
		if(empty($xml->results))
			$this->results = array();
		else
			$this->results = Kaltura_Client_Client::unmarshalItem($xml->results);
	}
	/**
	 * 
	 *
	 * @var int
	 */
	public $id = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $uploadedBy = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $uploadedByUserId = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $uploadedOn = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $numOfEntries = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_BatchJobStatus
	 */
	public $status = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $logFileUrl = null;

	/**
	 * DEPRECATED
	 *
	 * @var string
	 */
	public $csvFileUrl = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $bulkFileUrl = null;

	/**
	 * 
	 *
	 * @var array of KalturaBulkUploadResult
	 */
	public $results;


}

