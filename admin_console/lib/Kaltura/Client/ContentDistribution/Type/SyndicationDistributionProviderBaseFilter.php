<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_ContentDistribution_Type_SyndicationDistributionProviderBaseFilter extends Kaltura_Client_ContentDistribution_Type_DistributionProviderFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaSyndicationDistributionProviderBaseFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

