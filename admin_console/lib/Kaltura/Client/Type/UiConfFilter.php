<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_UiConfFilter extends Kaltura_Client_Type_UiConfBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaUiConfFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

