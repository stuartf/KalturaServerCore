<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_YouTubeDistribution_Type_YouTubeDistributionProfileFilter extends Kaltura_Client_YouTubeDistribution_Type_YouTubeDistributionProfileBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaYouTubeDistributionProfileFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

