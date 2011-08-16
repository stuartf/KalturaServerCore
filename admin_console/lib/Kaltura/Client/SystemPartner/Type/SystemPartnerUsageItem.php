<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_SystemPartner_Type_SystemPartnerUsageItem extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaSystemPartnerUsageItem';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->partnerId))
			$this->partnerId = (int)$xml->partnerId;
		$this->partnerName = (string)$xml->partnerName;
		if(count($xml->partnerStatus))
			$this->partnerStatus = (int)$xml->partnerStatus;
		if(count($xml->partnerPackage))
			$this->partnerPackage = (int)$xml->partnerPackage;
		if(count($xml->partnerCreatedAt))
			$this->partnerCreatedAt = (int)$xml->partnerCreatedAt;
		if(count($xml->views))
			$this->views = (int)$xml->views;
		if(count($xml->plays))
			$this->plays = (int)$xml->plays;
		if(count($xml->entriesCount))
			$this->entriesCount = (int)$xml->entriesCount;
		if(count($xml->totalEntriesCount))
			$this->totalEntriesCount = (int)$xml->totalEntriesCount;
		if(count($xml->videoEntriesCount))
			$this->videoEntriesCount = (int)$xml->videoEntriesCount;
		if(count($xml->imageEntriesCount))
			$this->imageEntriesCount = (int)$xml->imageEntriesCount;
		if(count($xml->audioEntriesCount))
			$this->audioEntriesCount = (int)$xml->audioEntriesCount;
		if(count($xml->mixEntriesCount))
			$this->mixEntriesCount = (int)$xml->mixEntriesCount;
		if(count($xml->bandwidth))
			$this->bandwidth = (float)$xml->bandwidth;
		if(count($xml->totalStorage))
			$this->totalStorage = (float)$xml->totalStorage;
		if(count($xml->storage))
			$this->storage = (float)$xml->storage;
	}
	/**
	 * Partner ID
	 * 
	 *
	 * @var int
	 */
	public $partnerId = null;

	/**
	 * Partner name
	 * 
	 *
	 * @var string
	 */
	public $partnerName = null;

	/**
	 * Partner status
	 * 
	 *
	 * @var Kaltura_Client_Enum_PartnerStatus
	 */
	public $partnerStatus = null;

	/**
	 * Partner package
	 * 
	 *
	 * @var int
	 */
	public $partnerPackage = null;

	/**
	 * Partner creation date (Unix timestamp)
	 * 
	 *
	 * @var int
	 */
	public $partnerCreatedAt = null;

	/**
	 * Number of player loads in the specific date range
	 * 
	 *
	 * @var int
	 */
	public $views = null;

	/**
	 * Number of plays in the specific date range
	 * 
	 *
	 * @var int
	 */
	public $plays = null;

	/**
	 * Number of new entries created during specific date range
	 * 
	 *
	 * @var int
	 */
	public $entriesCount = null;

	/**
	 * Total number of entries
	 * 
	 *
	 * @var int
	 */
	public $totalEntriesCount = null;

	/**
	 * Number of new video entries created during specific date range
	 * 
	 *
	 * @var int
	 */
	public $videoEntriesCount = null;

	/**
	 * Number of new image entries created during specific date range
	 * 
	 *
	 * @var int
	 */
	public $imageEntriesCount = null;

	/**
	 * Number of new audio entries created during specific date range
	 * 
	 *
	 * @var int
	 */
	public $audioEntriesCount = null;

	/**
	 * Number of new mix entries created during specific date range
	 * 
	 *
	 * @var int
	 */
	public $mixEntriesCount = null;

	/**
	 * The total bandwidth usage during the given date range (in MB)
	 * 
	 *
	 * @var float
	 */
	public $bandwidth = null;

	/**
	 * The total storage consumption (in MB)
	 * 
	 *
	 * @var float
	 */
	public $totalStorage = null;

	/**
	 * The change in storage consumption (new uploads) during the given date range (in MB)
	 * 
	 *
	 * @var float
	 */
	public $storage = null;


}

