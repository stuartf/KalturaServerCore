<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_MediaEntryFilter extends Kaltura_Client_Type_MediaEntryBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaMediaEntryFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

