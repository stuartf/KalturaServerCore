<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_LiveStreamAdminEntryFilter extends Kaltura_Client_Type_LiveStreamAdminEntryBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaLiveStreamAdminEntryFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

