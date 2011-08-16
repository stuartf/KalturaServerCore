<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_LiveStreamEntryFilter extends Kaltura_Client_Type_LiveStreamEntryBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaLiveStreamEntryFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

