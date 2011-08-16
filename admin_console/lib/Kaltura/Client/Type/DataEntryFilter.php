<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_DataEntryFilter extends Kaltura_Client_Type_DataEntryBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaDataEntryFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

