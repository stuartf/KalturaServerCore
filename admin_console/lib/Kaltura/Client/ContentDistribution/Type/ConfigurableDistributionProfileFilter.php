<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_ContentDistribution_Type_ConfigurableDistributionProfileFilter extends Kaltura_Client_ContentDistribution_Type_ConfigurableDistributionProfileBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaConfigurableDistributionProfileFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

