<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_Type_LiveStreamEntryBaseFilter extends Kaltura_Client_Type_MediaEntryFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaLiveStreamEntryBaseFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

