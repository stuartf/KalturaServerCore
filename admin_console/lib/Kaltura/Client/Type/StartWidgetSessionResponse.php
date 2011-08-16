<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_StartWidgetSessionResponse extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaStartWidgetSessionResponse';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->partnerId))
			$this->partnerId = (int)$xml->partnerId;
		$this->ks = (string)$xml->ks;
		$this->userId = (string)$xml->userId;
	}
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
	 * @readonly
	 */
	public $ks = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $userId = null;


}

