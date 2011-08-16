<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_String extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaString';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->value = (string)$xml->value;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $value = null;


}

