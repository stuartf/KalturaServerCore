<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_Scheduler extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaScheduler';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->id))
			$this->id = (int)$xml->id;
		if(count($xml->configuredId))
			$this->configuredId = (int)$xml->configuredId;
		$this->name = (string)$xml->name;
		$this->host = (string)$xml->host;
		if(empty($xml->statuses))
			$this->statuses = array();
		else
			$this->statuses = Kaltura_Client_Client::unmarshalItem($xml->statuses);
		if(empty($xml->configs))
			$this->configs = array();
		else
			$this->configs = Kaltura_Client_Client::unmarshalItem($xml->configs);
		if(empty($xml->workers))
			$this->workers = array();
		else
			$this->workers = Kaltura_Client_Client::unmarshalItem($xml->workers);
		if(count($xml->createdAt))
			$this->createdAt = (int)$xml->createdAt;
		if(count($xml->lastStatus))
			$this->lastStatus = (int)$xml->lastStatus;
		$this->lastStatusStr = (string)$xml->lastStatusStr;
	}
	/**
	 * The id of the Scheduler
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $id = null;

	/**
	 * The id as configured in the batch config
	 * 
	 *
	 * @var int
	 */
	public $configuredId = null;

	/**
	 * The scheduler name
	 * 
	 *
	 * @var string
	 */
	public $name = null;

	/**
	 * The host name
	 * 
	 *
	 * @var string
	 */
	public $host = null;

	/**
	 * Array of the last statuses
	 * 
	 *
	 * @var array of KalturaSchedulerStatus
	 * @readonly
	 */
	public $statuses;

	/**
	 * Array of the last configs
	 * 
	 *
	 * @var array of KalturaSchedulerConfig
	 * @readonly
	 */
	public $configs;

	/**
	 * Array of the workers
	 * 
	 *
	 * @var array of KalturaSchedulerWorker
	 * @readonly
	 */
	public $workers;

	/**
	 * creation time
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $createdAt = null;

	/**
	 * last status time
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $lastStatus = null;

	/**
	 * last status formated
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $lastStatusStr = null;


}

