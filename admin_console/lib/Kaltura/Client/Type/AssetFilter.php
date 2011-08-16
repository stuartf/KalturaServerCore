<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_AssetFilter extends Kaltura_Client_Type_AssetBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaAssetFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

