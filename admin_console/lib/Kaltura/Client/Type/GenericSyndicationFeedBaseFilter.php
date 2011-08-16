<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_Type_GenericSyndicationFeedBaseFilter extends Kaltura_Client_Type_BaseSyndicationFeedFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaGenericSyndicationFeedBaseFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

