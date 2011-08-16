<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_Notification extends Kaltura_Client_Type_BaseJob
{
	public function getKalturaObjectType()
	{
		return 'KalturaNotification';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->puserId = (string)$xml->puserId;
		if(count($xml->type))
			$this->type = (int)$xml->type;
		$this->objectId = (string)$xml->objectId;
		if(count($xml->status))
			$this->status = (int)$xml->status;
		$this->notificationData = (string)$xml->notificationData;
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
	public $puserId = null;

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
	public $notificationData = null;

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

