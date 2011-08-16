<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_BaseEntry extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaBaseEntry';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->id = (string)$xml->id;
		$this->name = (string)$xml->name;
		$this->description = (string)$xml->description;
		if(count($xml->partnerId))
			$this->partnerId = (int)$xml->partnerId;
		$this->userId = (string)$xml->userId;
		$this->tags = (string)$xml->tags;
		$this->adminTags = (string)$xml->adminTags;
		$this->categories = (string)$xml->categories;
		$this->categoriesIds = (string)$xml->categoriesIds;
		$this->status = (string)$xml->status;
		if(count($xml->moderationStatus))
			$this->moderationStatus = (int)$xml->moderationStatus;
		if(count($xml->moderationCount))
			$this->moderationCount = (int)$xml->moderationCount;
		$this->type = (string)$xml->type;
		if(count($xml->createdAt))
			$this->createdAt = (int)$xml->createdAt;
		if(count($xml->updatedAt))
			$this->updatedAt = (int)$xml->updatedAt;
		if(count($xml->rank))
			$this->rank = (float)$xml->rank;
		if(count($xml->totalRank))
			$this->totalRank = (int)$xml->totalRank;
		if(count($xml->votes))
			$this->votes = (int)$xml->votes;
		if(count($xml->groupId))
			$this->groupId = (int)$xml->groupId;
		$this->partnerData = (string)$xml->partnerData;
		$this->downloadUrl = (string)$xml->downloadUrl;
		$this->searchText = (string)$xml->searchText;
		if(count($xml->licenseType))
			$this->licenseType = (int)$xml->licenseType;
		if(count($xml->version))
			$this->version = (int)$xml->version;
		$this->thumbnailUrl = (string)$xml->thumbnailUrl;
		if(count($xml->accessControlId))
			$this->accessControlId = (int)$xml->accessControlId;
		if(count($xml->startDate))
			$this->startDate = (int)$xml->startDate;
		if(count($xml->endDate))
			$this->endDate = (int)$xml->endDate;
		$this->referenceId = (string)$xml->referenceId;
		$this->replacingEntryId = (string)$xml->replacingEntryId;
		$this->replacedEntryId = (string)$xml->replacedEntryId;
		$this->replacementStatus = (string)$xml->replacementStatus;
		if(count($xml->partnerSortValue))
			$this->partnerSortValue = (int)$xml->partnerSortValue;
		if(count($xml->conversionProfileId))
			$this->conversionProfileId = (int)$xml->conversionProfileId;
	}
	/**
	 * Auto generated 10 characters alphanumeric string
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $id = null;

	/**
	 * Entry name (Min 1 chars)
	 * 
	 *
	 * @var string
	 */
	public $name = null;

	/**
	 * Entry description
	 * 
	 *
	 * @var string
	 */
	public $description = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $partnerId = null;

	/**
	 * The ID of the user who is the owner of this entry 
	 * 
	 *
	 * @var string
	 */
	public $userId = null;

	/**
	 * Entry tags
	 * 
	 *
	 * @var string
	 */
	public $tags = null;

	/**
	 * Entry admin tags can be updated only by administrators
	 * 
	 *
	 * @var string
	 */
	public $adminTags = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $categories = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $categoriesIds = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_EntryStatus
	 * @readonly
	 */
	public $status = null;

	/**
	 * Entry moderation status
	 * 
	 *
	 * @var Kaltura_Client_Enum_EntryModerationStatus
	 * @readonly
	 */
	public $moderationStatus = null;

	/**
	 * Number of moderation requests waiting for this entry
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $moderationCount = null;

	/**
	 * The type of the entry, this is auto filled by the derived entry object
	 * 
	 *
	 * @var Kaltura_Client_Enum_EntryType
	 */
	public $type = null;

	/**
	 * Entry creation date as Unix timestamp (In seconds)
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $createdAt = null;

	/**
	 * Entry update date as Unix timestamp (In seconds)
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $updatedAt = null;

	/**
	 * Calculated rank
	 * 
	 *
	 * @var float
	 * @readonly
	 */
	public $rank = null;

	/**
	 * The total (sum) of all votes
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $totalRank = null;

	/**
	 * Number of votes
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $votes = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $groupId = null;

	/**
	 * Can be used to store various partner related data as a string 
	 * 
	 *
	 * @var string
	 */
	public $partnerData = null;

	/**
	 * Download URL for the entry
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $downloadUrl = null;

	/**
	 * Indexed search text for full text search
	 *
	 * @var string
	 * @readonly
	 */
	public $searchText = null;

	/**
	 * License type used for this entry
	 * 
	 *
	 * @var Kaltura_Client_Enum_LicenseType
	 */
	public $licenseType = null;

	/**
	 * Version of the entry data
	 *
	 * @var int
	 * @readonly
	 */
	public $version = null;

	/**
	 * Thumbnail URL
	 * 
	 *
	 * @var string
	 * @insertonly
	 */
	public $thumbnailUrl = null;

	/**
	 * The Access Control ID assigned to this entry (null when not set, send -1 to remove)  
	 * 
	 *
	 * @var int
	 */
	public $accessControlId = null;

	/**
	 * Entry scheduling start date (null when not set, send -1 to remove)
	 * 
	 *
	 * @var int
	 */
	public $startDate = null;

	/**
	 * Entry scheduling end date (null when not set, send -1 to remove)
	 * 
	 *
	 * @var int
	 */
	public $endDate = null;

	/**
	 * Entry external reference id
	 * 
	 *
	 * @var string
	 */
	public $referenceId = null;

	/**
	 * ID of temporary entry that will replace this entry when it's approved and ready for replacement
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $replacingEntryId = null;

	/**
	 * ID of the entry that will be replaced when the replacement approved and this entry is ready
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $replacedEntryId = null;

	/**
	 * Status of the replacement readiness and approval
	 * 
	 *
	 * @var Kaltura_Client_Enum_EntryReplacementStatus
	 * @readonly
	 */
	public $replacementStatus = null;

	/**
	 * Can be used to store various partner related data as a numeric value
	 * 
	 *
	 * @var int
	 */
	public $partnerSortValue = null;

	/**
	 * Override the default ingestion profile  
	 * 
	 *
	 * @var int
	 */
	public $conversionProfileId = null;


}

