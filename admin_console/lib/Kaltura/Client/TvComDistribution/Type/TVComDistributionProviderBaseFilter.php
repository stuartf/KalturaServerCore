<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_TvComDistribution_Type_TVComDistributionProviderBaseFilter extends Kaltura_Client_ContentDistribution_Type_DistributionProviderFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaTVComDistributionProviderBaseFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

