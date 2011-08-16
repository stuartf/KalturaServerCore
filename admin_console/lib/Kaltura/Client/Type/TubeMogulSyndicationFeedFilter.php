<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_TubeMogulSyndicationFeedFilter extends Kaltura_Client_Type_TubeMogulSyndicationFeedBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaTubeMogulSyndicationFeedFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

