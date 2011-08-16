<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_FreewheelDistribution_Type_FreewheelDistributionProfileFilter extends Kaltura_Client_FreewheelDistribution_Type_FreewheelDistributionProfileBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaFreewheelDistributionProfileFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

