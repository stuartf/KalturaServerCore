<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_YoutubeApiDistribution_Type_YoutubeApiDistributionProfileBaseFilter extends Kaltura_Client_ContentDistribution_Type_DistributionProfileFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaYoutubeApiDistributionProfileBaseFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

