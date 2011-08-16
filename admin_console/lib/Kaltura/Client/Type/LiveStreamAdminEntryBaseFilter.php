<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_Type_LiveStreamAdminEntryBaseFilter extends Kaltura_Client_Type_LiveStreamEntryFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaLiveStreamAdminEntryBaseFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

