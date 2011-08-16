<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_ClientNotification extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaClientNotification';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->url = (string)$xml->url;
		$this->data = (string)$xml->data;
	}
	/**
	 * The URL where the notification should be sent to 
	 *
	 * @var string
	 */
	public $url = null;

	/**
	 * The serialized notification data to send
	 *
	 * @var string
	 */
	public $data = null;


}

