<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_PartnerAggregation_Type_DwhHourlyPartnerFilter extends Kaltura_Client_PartnerAggregation_Type_DwhHourlyPartnerBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaDwhHourlyPartnerFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

