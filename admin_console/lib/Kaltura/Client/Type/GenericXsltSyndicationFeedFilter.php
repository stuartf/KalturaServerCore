<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_GenericXsltSyndicationFeedFilter extends Kaltura_Client_Type_GenericXsltSyndicationFeedBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaGenericXsltSyndicationFeedFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

