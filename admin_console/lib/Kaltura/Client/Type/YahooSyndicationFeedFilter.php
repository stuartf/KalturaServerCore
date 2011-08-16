<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_YahooSyndicationFeedFilter extends Kaltura_Client_Type_YahooSyndicationFeedBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaYahooSyndicationFeedFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

