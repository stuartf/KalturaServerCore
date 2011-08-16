<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_TvComDistribution_Type_TVComDistributionProvider extends Kaltura_Client_ContentDistribution_Type_DistributionProvider
{
	public function getKalturaObjectType()
	{
		return 'KalturaTVComDistributionProvider';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

