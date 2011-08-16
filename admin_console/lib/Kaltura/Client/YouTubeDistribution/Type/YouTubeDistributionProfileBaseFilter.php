<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_YouTubeDistribution_Type_YouTubeDistributionProfileBaseFilter extends Kaltura_Client_ContentDistribution_Type_ConfigurableDistributionProfileFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaYouTubeDistributionProfileBaseFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

