<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_FreewheelDistribution_Type_FreewheelDistributionProfileBaseFilter extends Kaltura_Client_ContentDistribution_Type_DistributionProfileFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaFreewheelDistributionProfileBaseFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

