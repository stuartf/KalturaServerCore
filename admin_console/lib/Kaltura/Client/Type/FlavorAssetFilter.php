<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_FlavorAssetFilter extends Kaltura_Client_Type_FlavorAssetBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaFlavorAssetFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

