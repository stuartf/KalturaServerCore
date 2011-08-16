<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_BaseSyndicationFeedFilter extends Kaltura_Client_Type_BaseSyndicationFeedBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaBaseSyndicationFeedFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

