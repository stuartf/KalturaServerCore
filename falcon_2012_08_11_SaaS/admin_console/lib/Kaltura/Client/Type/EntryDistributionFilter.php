<?php
class Kaltura_Client_Type_EntryDistributionFilter extends Kaltura_Client_ContentDistribution_Type_EntryDistributionBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaEntryDistributionFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

