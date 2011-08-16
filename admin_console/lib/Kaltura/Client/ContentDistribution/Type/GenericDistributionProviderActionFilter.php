<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_ContentDistribution_Type_GenericDistributionProviderActionFilter extends Kaltura_Client_ContentDistribution_Type_GenericDistributionProviderActionBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaGenericDistributionProviderActionFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

