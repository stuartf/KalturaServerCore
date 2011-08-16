<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_AdminUserFilter extends Kaltura_Client_Type_AdminUserBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaAdminUserFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

