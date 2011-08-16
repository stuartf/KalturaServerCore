<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_AssetParamsOutputFilter extends Kaltura_Client_Type_AssetParamsOutputBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaAssetParamsOutputFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

