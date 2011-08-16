<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_PodcastDistribution_Type_PodcastDistributionProviderFilter extends Kaltura_Client_PodcastDistribution_Type_PodcastDistributionProviderBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaPodcastDistributionProviderFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

