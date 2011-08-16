<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_Type_ThumbParamsBaseFilter extends Kaltura_Client_Type_AssetParamsFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaThumbParamsBaseFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

