<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_UserRoleFilter extends Kaltura_Client_Type_UserRoleBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaUserRoleFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

