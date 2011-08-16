<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_AssetParamsFilter extends Kaltura_Client_Type_AssetParamsBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaAssetParamsFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

