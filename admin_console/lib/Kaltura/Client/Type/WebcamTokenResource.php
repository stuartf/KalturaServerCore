<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_WebcamTokenResource extends Kaltura_Client_Type_DataCenterContentResource
{
	public function getKalturaObjectType()
	{
		return 'KalturaWebcamTokenResource';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->token = (string)$xml->token;
	}
	/**
	 * Token that returned from media server such as FMS or red5. 
	 *
	 * @var string
	 */
	public $token = null;


}

