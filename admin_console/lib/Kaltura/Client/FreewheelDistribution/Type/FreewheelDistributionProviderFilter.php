<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_FreewheelDistribution_Type_FreewheelDistributionProviderFilter extends Kaltura_Client_FreewheelDistribution_Type_FreewheelDistributionProviderBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaFreewheelDistributionProviderFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

