<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_AdminUser extends Kaltura_Client_Type_User
{
	public function getKalturaObjectType()
	{
		return 'KalturaAdminUser';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

