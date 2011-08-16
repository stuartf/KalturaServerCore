<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_Type_MixEntryBaseFilter extends Kaltura_Client_Type_PlayableEntryFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaMixEntryBaseFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

