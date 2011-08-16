<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_BatchJob extends Kaltura_Client_Type_BaseJob
{
	public function getKalturaObjectType()
	{
		return 'KalturaBatchJob';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->entryId = (string)$xml->entryId;
		$this->entryName = (string)$xml->entryName;
		$this->jobType = (string)$xml->jobType;
		if(count($xml->jobSubType))
			$this->jobSubType = (int)$xml->jobSubType;
		if(count($xml->onStressDivertTo))
			$this->onStressDivertTo = (int)$xml->onStressDivertTo;
		if(!empty($xml->data))
			$this->data = Kaltura_Client_Client::unmarshalItem($xml->data);
		if(count($xml->status))
			$this->status = (int)$xml->status;
		if(count($xml->abort))
			$this->abort = (int)$xml->abort;
		if(count($xml->checkAgainTimeout))
			$this->checkAgainTimeout = (int)$xml->checkAgainTimeout;
		if(count($xml->progress))
			$this->progress = (int)$xml->progress;
		$this->message = (string)$xml->message;
		$this->description = (string)$xml->description;
		if(count($xml->updatesCount))
			$this->updatesCount = (int)$xml->updatesCount;
		if(count($xml->priority))
			$this->priority = (int)$xml->priority;
		if(count($xml->twinJobId))
			$this->twinJobId = (int)$xml->twinJobId;
		if(count($xml->bulkJobId))
			$this->bulkJobId = (int)$xml->bulkJobId;
		if(count($xml->parentJobId))
			$this->parentJobId = (int)$xml->parentJobId;
		if(count($xml->rootJobId))
			$this->rootJobId = (int)$xml->rootJobId;
		if(count($xml->queueTime))
			$this->queueTime = (int)$xml->queueTime;
		if(count($xml->finishTime))
			$this->finishTime = (int)$xml->finishTime;
		if(count($xml->errType))
			$this->errType = (int)$xml->errType;
		if(count($xml->errNumber))
			$this->errNumber = (int)$xml->errNumber;
		if(count($xml->fileSize))
			$this->fileSize = (int)$xml->fileSize;
		if(!empty($xml->lastWorkerRemote))
			$this->lastWorkerRemote = true;
		if(count($xml->schedulerId))
			$this->schedulerId = (int)$xml->schedulerId;
		if(count($xml->workerId))
			$this->workerId = (int)$xml->workerId;
		if(count($xml->batchIndex))
			$this->batchIndex = (int)$xml->batchIndex;
		if(count($xml->lastSchedulerId))
			$this->lastSchedulerId = (int)$xml->lastSchedulerId;
		if(count($xml->lastWorkerId))
			$this->lastWorkerId = (int)$xml->lastWorkerId;
		if(count($xml->dc))
			$this->dc = (int)$xml->dc;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $entryId = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $entryName = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_BatchJobType
	 * @readonly
	 */
	public $jobType = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $jobSubType = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $onStressDivertTo = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Type_JobData
	 */
	public $data;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_BatchJobStatus
	 */
	public $status = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $abort = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $checkAgainTimeout = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $progress = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $message = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $description = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $updatesCount = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $priority = null;

	/**
	 * The id of identical job
	 *
	 * @var int
	 */
	public $twinJobId = null;

	/**
	 * The id of the bulk upload job that initiated this job
	 *
	 * @var int
	 */
	public $bulkJobId = null;

	/**
	 * When one job creates another - the parent should set this parentJobId to be its own id.
	 *
	 * @var int
	 */
	public $parentJobId = null;

	/**
	 * The id of the root parent job
	 *
	 * @var int
	 */
	public $rootJobId = null;

	/**
	 * The time that the job was pulled from the queue
	 *
	 * @var int
	 */
	public $queueTime = null;

	/**
	 * The time that the job was finished or closed as failed
	 *
	 * @var int
	 */
	public $finishTime = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_BatchJobErrorTypes
	 */
	public $errType = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $errNumber = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $fileSize = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	public $lastWorkerRemote = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $schedulerId = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $workerId = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $batchIndex = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $lastSchedulerId = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $lastWorkerId = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $dc = null;


}

