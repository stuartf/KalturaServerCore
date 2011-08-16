<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_Type_ContentResource extends Kaltura_Client_Type_Resource
{
	public function getKalturaObjectType()
	{
		return 'KalturaContentResource';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

