<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_AdminConsole_Type_TrackEntry extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaTrackEntry';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->id))
			$this->id = (int)$xml->id;
		if(count($xml->trackEventType))
			$this->trackEventType = (int)$xml->trackEventType;
		$this->psVersion = (string)$xml->psVersion;
		$this->context = (string)$xml->context;
		if(count($xml->partnerId))
			$this->partnerId = (int)$xml->partnerId;
		$this->entryId = (string)$xml->entryId;
		$this->hostName = (string)$xml->hostName;
		$this->userId = (string)$xml->userId;
		$this->changedProperties = (string)$xml->changedProperties;
		$this->paramStr1 = (string)$xml->paramStr1;
		$this->paramStr2 = (string)$xml->paramStr2;
		$this->paramStr3 = (string)$xml->paramStr3;
		$this->ks = (string)$xml->ks;
		$this->description = (string)$xml->description;
		if(count($xml->createdAt))
			$this->createdAt = (int)$xml->createdAt;
		if(count($xml->updatedAt))
			$this->updatedAt = (int)$xml->updatedAt;
		$this->userIp = (string)$xml->userIp;
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
	 * @var Kaltura_Client_AdminConsole_Enum_TrackEntryEventType
	 */
	public $trackEventType = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $psVersion = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $context = null;

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
	 * @var string
	 */
	public $hostName = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $userId = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $changedProperties = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $paramStr1 = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $paramStr2 = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $paramStr3 = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $ks = null;

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
	public $createdAt = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $updatedAt = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $userIp = null;


}

