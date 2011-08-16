<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_ContentDistribution_Type_DistributionSubmitJobData extends Kaltura_Client_ContentDistribution_Type_DistributionJobData
{
	public function getKalturaObjectType()
	{
		return 'KalturaDistributionSubmitJobData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

