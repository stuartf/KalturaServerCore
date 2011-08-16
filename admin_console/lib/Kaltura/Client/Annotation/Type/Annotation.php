<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Annotation_Type_Annotation extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaAnnotation';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->id = (string)$xml->id;
		$this->entryId = (string)$xml->entryId;
		if(count($xml->partnerId))
			$this->partnerId = (int)$xml->partnerId;
		$this->parentId = (string)$xml->parentId;
		if(count($xml->createdAt))
			$this->createdAt = (int)$xml->createdAt;
		if(count($xml->updatedAt))
			$this->updatedAt = (int)$xml->updatedAt;
		$this->text = (string)$xml->text;
		$this->tags = (string)$xml->tags;
		if(count($xml->startTime))
			$this->startTime = (int)$xml->startTime;
		if(count($xml->endTime))
			$this->endTime = (int)$xml->endTime;
		$this->userId = (string)$xml->userId;
		$this->partnerData = (string)$xml->partnerData;
	}
	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $id = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $entryId = null;

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
	public $parentId = null;

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
	 * @var string
	 */
	public $text = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $tags = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $startTime = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $endTime = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $userId = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $partnerData = null;


}

