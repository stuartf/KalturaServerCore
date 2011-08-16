<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_ControlPanelCommand extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaControlPanelCommand';
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
		$this->createdBy = (string)$xml->createdBy;
		if(count($xml->updatedAt))
			$this->updatedAt = (int)$xml->updatedAt;
		$this->updatedBy = (string)$xml->updatedBy;
		if(count($xml->createdById))
			$this->createdById = (int)$xml->createdById;
		if(count($xml->schedulerId))
			$this->schedulerId = (int)$xml->schedulerId;
		if(count($xml->workerId))
			$this->workerId = (int)$xml->workerId;
		if(count($xml->workerConfiguredId))
			$this->workerConfiguredId = (int)$xml->workerConfiguredId;
		if(count($xml->workerName))
			$this->workerName = (int)$xml->workerName;
		if(count($xml->batchIndex))
			$this->batchIndex = (int)$xml->batchIndex;
		if(count($xml->type))
			$this->type = (int)$xml->type;
		if(count($xml->targetType))
			$this->targetType = (int)$xml->targetType;
		if(count($xml->status))
			$this->status = (int)$xml->status;
		$this->cause = (string)$xml->cause;
		$this->description = (string)$xml->description;
		$this->errorDescription = (string)$xml->errorDescription;
	}
	/**
	 * The id of the Category
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $id = null;

	/**
	 * Creation date as Unix timestamp (In seconds)
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $createdAt = null;

	/**
	 * Creator name
	 * 
	 *
	 * @var string
	 */
	public $createdBy = null;

	/**
	 * Update date as Unix timestamp (In seconds)
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $updatedAt = null;

	/**
	 * Updater name
	 * 
	 *
	 * @var string
	 */
	public $updatedBy = null;

	/**
	 * Creator id
	 * 
	 *
	 * @var int
	 */
	public $createdById = null;

	/**
	 * The id of the scheduler that the command refers to
	 * 
	 *
	 * @var int
	 */
	public $schedulerId = null;

	/**
	 * The id of the scheduler worker that the command refers to
	 * 
	 *
	 * @var int
	 */
	public $workerId = null;

	/**
	 * The id of the scheduler worker as configured in the ini file
	 * 
	 *
	 * @var int
	 */
	public $workerConfiguredId = null;

	/**
	 * The name of the scheduler worker that the command refers to
	 * 
	 *
	 * @var int
	 */
	public $workerName = null;

	/**
	 * The index of the batch process that the command refers to
	 * 
	 *
	 * @var int
	 */
	public $batchIndex = null;

	/**
	 * The command type - stop / start / config
	 * 
	 *
	 * @var Kaltura_Client_Enum_ControlPanelCommandType
	 */
	public $type = null;

	/**
	 * The command target type - data center / scheduler / job / job type
	 * 
	 *
	 * @var Kaltura_Client_Enum_ControlPanelCommandTargetType
	 */
	public $targetType = null;

	/**
	 * The command status
	 * 
	 *
	 * @var Kaltura_Client_Enum_ControlPanelCommandStatus
	 */
	public $status = null;

	/**
	 * The reason for the command
	 * 
	 *
	 * @var string
	 */
	public $cause = null;

	/**
	 * Command description
	 * 
	 *
	 * @var string
	 */
	public $description = null;

	/**
	 * Error description
	 * 
	 *
	 * @var string
	 */
	public $errorDescription = null;


}

