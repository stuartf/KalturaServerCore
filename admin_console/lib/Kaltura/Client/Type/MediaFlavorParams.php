<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_MediaFlavorParams extends Kaltura_Client_Type_FlavorParams
{
	public function getKalturaObjectType()
	{
		return 'KalturaMediaFlavorParams';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

