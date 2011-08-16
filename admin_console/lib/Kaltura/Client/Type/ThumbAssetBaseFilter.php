<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_Type_ThumbAssetBaseFilter extends Kaltura_Client_Type_AssetFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaThumbAssetBaseFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

