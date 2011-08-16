<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_PermissionFilter extends Kaltura_Client_Type_PermissionBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaPermissionFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

