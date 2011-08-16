<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_KalturaInternalTools_Type_InternalToolsSession extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaInternalToolsSession';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->partner_id))
			$this->partner_id = (int)$xml->partner_id;
		if(count($xml->valid_until))
			$this->valid_until = (int)$xml->valid_until;
		$this->partner_pattern = (string)$xml->partner_pattern;
		if(count($xml->type))
			$this->type = (int)$xml->type;
		$this->error = (string)$xml->error;
		if(count($xml->rand))
			$this->rand = (int)$xml->rand;
		$this->user = (string)$xml->user;
		$this->privileges = (string)$xml->privileges;
	}
	/**
	 * 
	 *
	 * @var int
	 */
	public $partner_id = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $valid_until = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $partner_pattern = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_SessionType
	 */
	public $type = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $error = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $rand = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $user = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $privileges = null;


}

