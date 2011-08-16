<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_AccessControlFilter extends Kaltura_Client_Type_AccessControlBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaAccessControlFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

