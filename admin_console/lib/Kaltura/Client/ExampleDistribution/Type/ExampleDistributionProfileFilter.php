<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_ExampleDistribution_Type_ExampleDistributionProfileFilter extends Kaltura_Client_ExampleDistribution_Type_ExampleDistributionProfileBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaExampleDistributionProfileFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

