<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_ContentDistribution_Type_GenericDistributionProfileFilter extends Kaltura_Client_ContentDistribution_Type_GenericDistributionProfileBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaGenericDistributionProfileFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

