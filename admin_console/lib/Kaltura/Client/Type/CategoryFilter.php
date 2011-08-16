<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_CategoryFilter extends Kaltura_Client_Type_CategoryBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaCategoryFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

