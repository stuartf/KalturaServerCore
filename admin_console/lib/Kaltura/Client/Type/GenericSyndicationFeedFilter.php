<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_GenericSyndicationFeedFilter extends Kaltura_Client_Type_GenericSyndicationFeedBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaGenericSyndicationFeedFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

