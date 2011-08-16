<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_ContentDistribution_Type_DistributionDeleteJobData extends Kaltura_Client_ContentDistribution_Type_DistributionJobData
{
	public function getKalturaObjectType()
	{
		return 'KalturaDistributionDeleteJobData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

