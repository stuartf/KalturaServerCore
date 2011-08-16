<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_Type_FlavorAssetBaseFilter extends Kaltura_Client_Type_AssetFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaFlavorAssetBaseFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

