<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_DynamicEnum extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaDynamicEnum';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

