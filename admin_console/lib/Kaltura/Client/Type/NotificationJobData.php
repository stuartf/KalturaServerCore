<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_NotificationJobData extends Kaltura_Client_Type_JobData
{
	public function getKalturaObjectType()
	{
		return 'KalturaNotificationJobData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->userId = (string)$xml->userId;
		if(count($xml->type))
			$this->type = (int)$xml->type;
		$this->typeAsString = (string)$xml->typeAsString;
		$this->objectId = (string)$xml->objectId;
		if(count($xml->status))
			$this->status = (int)$xml->status;
		$this->data = (string)$xml->data;
		if(count($xml->numberOfAttempts))
			$this->numberOfAttempts = (int)$xml->numberOfAttempts;
		$this->notificationResult = (string)$xml->notificationResult;
		if(count($xml->objType))
			$this->objType = (int)$xml->objType;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $userId = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_NotificationType
	 */
	public $type = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $typeAsString = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $objectId = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_NotificationStatus
	 */
	public $status = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $data = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $numberOfAttempts = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $notificationResult = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_NotificationObjectType
	 */
	public $objType = null;


}

