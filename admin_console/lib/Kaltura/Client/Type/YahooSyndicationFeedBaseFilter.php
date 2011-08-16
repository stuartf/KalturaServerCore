<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_Type_YahooSyndicationFeedBaseFilter extends Kaltura_Client_Type_BaseSyndicationFeedFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaYahooSyndicationFeedBaseFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

