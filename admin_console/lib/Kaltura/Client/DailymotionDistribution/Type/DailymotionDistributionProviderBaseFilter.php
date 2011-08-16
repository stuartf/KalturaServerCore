<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_DailymotionDistribution_Type_DailymotionDistributionProviderBaseFilter extends Kaltura_Client_ContentDistribution_Type_DistributionProviderFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaDailymotionDistributionProviderBaseFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

