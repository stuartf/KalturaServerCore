<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_GoogleVideoSyndicationFeedFilter extends Kaltura_Client_Type_GoogleVideoSyndicationFeedBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaGoogleVideoSyndicationFeedFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

