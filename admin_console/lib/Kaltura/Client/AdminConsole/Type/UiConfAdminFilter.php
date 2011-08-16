<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_AdminConsole_Type_UiConfAdminFilter extends Kaltura_Client_AdminConsole_Type_UiConfAdminBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaUiConfAdminFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

