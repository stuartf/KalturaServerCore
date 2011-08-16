<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_PermissionItemFilter extends Kaltura_Client_Type_PermissionItemBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaPermissionItemFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

