<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_LiveStreamAdminEntry extends Kaltura_Client_Type_LiveStreamEntry
{
	public function getKalturaObjectType()
	{
		return 'KalturaLiveStreamAdminEntry';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->encodingIP1 = (string)$xml->encodingIP1;
		$this->encodingIP2 = (string)$xml->encodingIP2;
		$this->streamPassword = (string)$xml->streamPassword;
		$this->streamUsername = (string)$xml->streamUsername;
	}
	/**
	 * The broadcast primary ip
	 * 
	 *
	 * @var string
	 */
	public $encodingIP1 = null;

	/**
	 * The broadcast secondary ip
	 * 
	 *
	 * @var string
	 */
	public $encodingIP2 = null;

	/**
	 * The broadcast password
	 * 
	 *
	 * @var string
	 */
	public $streamPassword = null;

	/**
	 * The broadcast username
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $streamUsername = null;


}

