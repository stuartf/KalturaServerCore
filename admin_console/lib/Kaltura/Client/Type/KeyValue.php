<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_KeyValue extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaKeyValue';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->key = (string)$xml->key;
		$this->value = (string)$xml->value;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $key = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $value = null;


}

