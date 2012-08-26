<?php
class Kaltura_Client_Type_CuePointFilter extends Kaltura_Client_CuePoint_Type_CuePointBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaCuePointFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

