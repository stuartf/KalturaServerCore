<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_Type_DataEntryBaseFilter extends Kaltura_Client_Type_BaseEntryFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaDataEntryBaseFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

