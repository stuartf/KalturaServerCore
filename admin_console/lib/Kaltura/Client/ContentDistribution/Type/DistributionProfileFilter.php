<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_ContentDistribution_Type_DistributionProfileFilter extends Kaltura_Client_ContentDistribution_Type_DistributionProfileBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaDistributionProfileFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

