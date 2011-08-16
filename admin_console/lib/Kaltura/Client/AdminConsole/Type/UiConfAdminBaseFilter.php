<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_AdminConsole_Type_UiConfAdminBaseFilter extends Kaltura_Client_Type_UiConfFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaUiConfAdminBaseFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

