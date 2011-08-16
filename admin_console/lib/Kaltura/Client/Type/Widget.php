<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_Widget extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaWidget';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->id = (string)$xml->id;
		$this->sourceWidgetId = (string)$xml->sourceWidgetId;
		$this->rootWidgetId = (string)$xml->rootWidgetId;
		if(count($xml->partnerId))
			$this->partnerId = (int)$xml->partnerId;
		$this->entryId = (string)$xml->entryId;
		if(count($xml->uiConfId))
			$this->uiConfId = (int)$xml->uiConfId;
		if(count($xml->securityType))
			$this->securityType = (int)$xml->securityType;
		if(count($xml->securityPolicy))
			$this->securityPolicy = (int)$xml->securityPolicy;
		if(count($xml->createdAt))
			$this->createdAt = (int)$xml->createdAt;
		if(count($xml->updatedAt))
			$this->updatedAt = (int)$xml->updatedAt;
		$this->partnerData = (string)$xml->partnerData;
		$this->widgetHTML = (string)$xml->widgetHTML;
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
	public $sourceWidgetId = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $rootWidgetId = null;

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
	public $entryId = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $uiConfId = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_WidgetSecurityType
	 */
	public $securityType = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $securityPolicy = null;

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
	 * Can be used to store various partner related data as a string 
	 *
	 * @var string
	 */
	public $partnerData = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $widgetHTML = null;


}

