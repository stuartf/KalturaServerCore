<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_EmailIngestionProfile extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaEmailIngestionProfile';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->id))
			$this->id = (int)$xml->id;
		$this->name = (string)$xml->name;
		$this->description = (string)$xml->description;
		$this->emailAddress = (string)$xml->emailAddress;
		$this->mailboxId = (string)$xml->mailboxId;
		if(count($xml->partnerId))
			$this->partnerId = (int)$xml->partnerId;
		if(count($xml->conversionProfile2Id))
			$this->conversionProfile2Id = (int)$xml->conversionProfile2Id;
		if(count($xml->moderationStatus))
			$this->moderationStatus = (int)$xml->moderationStatus;
		if(count($xml->status))
			$this->status = (int)$xml->status;
		$this->createdAt = (string)$xml->createdAt;
		$this->defaultCategory = (string)$xml->defaultCategory;
		$this->defaultUserId = (string)$xml->defaultUserId;
		$this->defaultTags = (string)$xml->defaultTags;
		$this->defaultAdminTags = (string)$xml->defaultAdminTags;
		if(count($xml->maxAttachmentSizeKbytes))
			$this->maxAttachmentSizeKbytes = (int)$xml->maxAttachmentSizeKbytes;
		if(count($xml->maxAttachmentsPerMail))
			$this->maxAttachmentsPerMail = (int)$xml->maxAttachmentsPerMail;
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
	 * @var string
	 */
	public $name = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $description = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $emailAddress = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $mailboxId = null;

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
	 * @var int
	 */
	public $conversionProfile2Id = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_EntryModerationStatus
	 */
	public $moderationStatus = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_EmailIngestionProfileStatus
	 * @readonly
	 */
	public $status = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $createdAt = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $defaultCategory = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $defaultUserId = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $defaultTags = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $defaultAdminTags = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $maxAttachmentSizeKbytes = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $maxAttachmentsPerMail = null;


}

