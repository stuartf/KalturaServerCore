<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_Type_SearchItem extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaSearchItem';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

