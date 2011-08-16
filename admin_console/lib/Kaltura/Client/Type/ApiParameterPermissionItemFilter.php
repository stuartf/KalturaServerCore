<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_ApiParameterPermissionItemFilter extends Kaltura_Client_Type_ApiParameterPermissionItemBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaApiParameterPermissionItemFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

