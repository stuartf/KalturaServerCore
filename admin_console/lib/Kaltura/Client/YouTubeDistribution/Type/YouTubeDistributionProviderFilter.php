<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_YouTubeDistribution_Type_YouTubeDistributionProviderFilter extends Kaltura_Client_YouTubeDistribution_Type_YouTubeDistributionProviderBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaYouTubeDistributionProviderFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

