<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_DailymotionDistribution_Type_DailymotionDistributionProviderFilter extends Kaltura_Client_DailymotionDistribution_Type_DailymotionDistributionProviderBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaDailymotionDistributionProviderFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

