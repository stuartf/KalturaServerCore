<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_ContentDistribution_Type_DistributionEnableJobData extends Kaltura_Client_ContentDistribution_Type_DistributionUpdateJobData
{
	public function getKalturaObjectType()
	{
		return 'KalturaDistributionEnableJobData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

