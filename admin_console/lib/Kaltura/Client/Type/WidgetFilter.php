<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_WidgetFilter extends Kaltura_Client_Type_WidgetBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaWidgetFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

