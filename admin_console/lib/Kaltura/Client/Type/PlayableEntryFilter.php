<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_PlayableEntryFilter extends Kaltura_Client_Type_PlayableEntryBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaPlayableEntryFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

