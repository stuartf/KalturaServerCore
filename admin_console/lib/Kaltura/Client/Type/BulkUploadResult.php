<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_BulkUploadResult extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaBulkUploadResult';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->id))
			$this->id = (int)$xml->id;
		if(count($xml->bulkUploadJobId))
			$this->bulkUploadJobId = (int)$xml->bulkUploadJobId;
		if(count($xml->lineIndex))
			$this->lineIndex = (int)$xml->lineIndex;
		if(count($xml->partnerId))
			$this->partnerId = (int)$xml->partnerId;
		$this->entryId = (string)$xml->entryId;
		if(count($xml->entryStatus))
			$this->entryStatus = (int)$xml->entryStatus;
		$this->rowData = (string)$xml->rowData;
		$this->title = (string)$xml->title;
		$this->description = (string)$xml->description;
		$this->tags = (string)$xml->tags;
		$this->url = (string)$xml->url;
		$this->contentType = (string)$xml->contentType;
		if(count($xml->conversionProfileId))
			$this->conversionProfileId = (int)$xml->conversionProfileId;
		if(count($xml->accessControlProfileId))
			$this->accessControlProfileId = (int)$xml->accessControlProfileId;
		$this->category = (string)$xml->category;
		if(count($xml->scheduleStartDate))
			$this->scheduleStartDate = (int)$xml->scheduleStartDate;
		if(count($xml->scheduleEndDate))
			$this->scheduleEndDate = (int)$xml->scheduleEndDate;
		$this->thumbnailUrl = (string)$xml->thumbnailUrl;
		if(!empty($xml->thumbnailSaved))
			$this->thumbnailSaved = true;
		$this->partnerData = (string)$xml->partnerData;
		$this->errorDescription = (string)$xml->errorDescription;
		if(empty($xml->pluginsData))
			$this->pluginsData = array();
		else
			$this->pluginsData = Kaltura_Client_Client::unmarshalItem($xml->pluginsData);
	}
	/**
	 * The id of the result
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $id = null;

	/**
	 * The id of the parent job
	 * 
	 *
	 * @var int
	 */
	public $bulkUploadJobId = null;

	/**
	 * The index of the line in the CSV
	 * 
	 *
	 * @var int
	 */
	public $lineIndex = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $partnerId = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $entryId = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $entryStatus = null;

	/**
	 * The data as recieved in the csv
	 * 
	 *
	 * @var string
	 */
	public $rowData = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $title = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $description = null;

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
	public $url = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $contentType = null;

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
	public $accessControlProfileId = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $category = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $scheduleStartDate = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $scheduleEndDate = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $thumbnailUrl = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	public $thumbnailSaved = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $partnerData = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $errorDescription = null;

	/**
	 * 
	 *
	 * @var array of KalturaBulkUploadPluginData
	 */
	public $pluginsData;


}

