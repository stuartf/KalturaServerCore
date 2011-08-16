<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_BulkUploadJobData extends Kaltura_Client_Type_JobData
{
	public function getKalturaObjectType()
	{
		return 'KalturaBulkUploadJobData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->userId = (string)$xml->userId;
		$this->uploadedBy = (string)$xml->uploadedBy;
		if(count($xml->conversionProfileId))
			$this->conversionProfileId = (int)$xml->conversionProfileId;
		$this->resultsFileLocalPath = (string)$xml->resultsFileLocalPath;
		$this->resultsFileUrl = (string)$xml->resultsFileUrl;
		if(count($xml->numOfEntries))
			$this->numOfEntries = (int)$xml->numOfEntries;
		$this->filePath = (string)$xml->filePath;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $userId = null;

	/**
	 * The screen name of the user
	 * 
	 *
	 * @var string
	 */
	public $uploadedBy = null;

	/**
	 * Selected profile id for all bulk entries
	 * 
	 *
	 * @var int
	 */
	public $conversionProfileId = null;

	/**
	 * Created by the API
	 * 
	 *
	 * @var string
	 */
	public $resultsFileLocalPath = null;

	/**
	 * Created by the API
	 * 
	 *
	 * @var string
	 */
	public $resultsFileUrl = null;

	/**
	 * Number of created entries
	 * 
	 *
	 * @var int
	 */
	public $numOfEntries = null;

	/**
	 * The bulk upload file path
	 *
	 * @var string
	 */
	public $filePath = null;


}

