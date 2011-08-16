<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_TvComDistribution_Type_TVComDistributionProfileFilter extends Kaltura_Client_TvComDistribution_Type_TVComDistributionProfileBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaTVComDistributionProfileFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

