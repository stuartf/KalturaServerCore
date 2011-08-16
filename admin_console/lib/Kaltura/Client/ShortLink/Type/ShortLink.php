<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_ShortLink_Type_ShortLink extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaShortLink';
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
		if(count($xml->expiresAt))
			$this->expiresAt = (int)$xml->expiresAt;
		if(count($xml->partnerId))
			$this->partnerId = (int)$xml->partnerId;
		$this->userId = (string)$xml->userId;
		$this->name = (string)$xml->name;
		$this->systemName = (string)$xml->systemName;
		$this->fullUrl = (string)$xml->fullUrl;
		if(count($xml->status))
			$this->status = (int)$xml->status;
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
	 */
	public $expiresAt = null;

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
	public $userId = null;

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
	public $systemName = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $fullUrl = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_ShortLink_Enum_ShortLinkStatus
	 */
	public $status = null;


}

