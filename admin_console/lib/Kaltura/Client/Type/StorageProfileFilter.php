<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_StorageProfileFilter extends Kaltura_Client_Type_StorageProfileBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaStorageProfileFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

