<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_ComcastMrssDistribution_Type_ComcastMrssDistributionProfileFilter extends Kaltura_Client_ComcastMrssDistribution_Type_ComcastMrssDistributionProfileBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaComcastMrssDistributionProfileFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

