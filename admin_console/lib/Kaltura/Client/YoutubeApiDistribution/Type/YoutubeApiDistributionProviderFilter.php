<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_YoutubeApiDistribution_Type_YoutubeApiDistributionProviderFilter extends Kaltura_Client_YoutubeApiDistribution_Type_YoutubeApiDistributionProviderBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaYoutubeApiDistributionProviderFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

