<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_Type_GenericXsltSyndicationFeedBaseFilter extends Kaltura_Client_Type_GenericSyndicationFeedFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaGenericXsltSyndicationFeedBaseFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

