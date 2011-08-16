<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_ComcastMrssDistribution_Type_ComcastMrssDistributionProviderFilter extends Kaltura_Client_ComcastMrssDistribution_Type_ComcastMrssDistributionProviderBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaComcastMrssDistributionProviderFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

