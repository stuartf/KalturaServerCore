<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_PodcastDistribution_Type_PodcastDistributionProfileFilter extends Kaltura_Client_PodcastDistribution_Type_PodcastDistributionProfileBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaPodcastDistributionProfileFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

