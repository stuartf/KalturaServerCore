<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_FreewheelDistribution_Type_FreewheelDistributionProvider extends Kaltura_Client_ContentDistribution_Type_DistributionProvider
{
	public function getKalturaObjectType()
	{
		return 'KalturaFreewheelDistributionProvider';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

