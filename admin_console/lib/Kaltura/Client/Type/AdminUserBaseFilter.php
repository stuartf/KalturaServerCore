<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_Type_AdminUserBaseFilter extends Kaltura_Client_Type_UserFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaAdminUserBaseFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

