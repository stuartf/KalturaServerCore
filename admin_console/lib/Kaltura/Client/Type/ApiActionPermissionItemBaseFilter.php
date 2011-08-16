<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_Type_ApiActionPermissionItemBaseFilter extends Kaltura_Client_Type_PermissionItemFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaApiActionPermissionItemBaseFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

