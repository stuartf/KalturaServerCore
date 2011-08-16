<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_ThumbAssetFilter extends Kaltura_Client_Type_ThumbAssetBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaThumbAssetFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

