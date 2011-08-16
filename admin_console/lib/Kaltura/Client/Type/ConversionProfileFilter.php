<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_ConversionProfileFilter extends Kaltura_Client_Type_ConversionProfileBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaConversionProfileFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

