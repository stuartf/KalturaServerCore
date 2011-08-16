<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_ContentDistribution_Type_ConfigurableDistributionProfileBaseFilter extends Kaltura_Client_ContentDistribution_Type_DistributionProfileFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaConfigurableDistributionProfileBaseFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

