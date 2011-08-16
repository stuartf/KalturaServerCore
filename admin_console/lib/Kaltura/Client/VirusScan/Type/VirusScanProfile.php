<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_VirusScan_Type_VirusScanProfile extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaVirusScanProfile';
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
		if(count($xml->updatedAt))
			$this->updatedAt = (int)$xml->updatedAt;
		if(count($xml->partnerId))
			$this->partnerId = (int)$xml->partnerId;
		$this->name = (string)$xml->name;
		if(count($xml->status))
			$this->status = (int)$xml->status;
		$this->engineType = (string)$xml->engineType;
		if(!empty($xml->entryFilter))
			$this->entryFilter = Kaltura_Client_Client::unmarshalItem($xml->entryFilter);
		if(count($xml->actionIfInfected))
			$this->actionIfInfected = (int)$xml->actionIfInfected;
	}
	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $id = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $createdAt = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $updatedAt = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $partnerId = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $name = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_VirusScan_Enum_VirusScanProfileStatus
	 */
	public $status = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_VirusScan_Enum_VirusScanEngineType
	 */
	public $engineType = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Type_BaseEntryFilter
	 */
	public $entryFilter;

	/**
	 * 
	 *
	 * @var Kaltura_Client_VirusScan_Enum_VirusFoundAction
	 */
	public $actionIfInfected = null;


}

