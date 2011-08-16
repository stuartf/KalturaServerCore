<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_ContentDistribution_Type_SyndicationDistributionProfileFilter extends Kaltura_Client_ContentDistribution_Type_SyndicationDistributionProfileBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaSyndicationDistributionProfileFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

