<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_ControlPanelCommandFilter extends Kaltura_Client_Type_ControlPanelCommandBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaControlPanelCommandFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

