<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_YoutubeApiDistribution_Type_YoutubeApiDistributionProfileFilter extends Kaltura_Client_YoutubeApiDistribution_Type_YoutubeApiDistributionProfileBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaYoutubeApiDistributionProfileFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

