<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_MediaFlavorParamsFilter extends Kaltura_Client_Type_MediaFlavorParamsBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaMediaFlavorParamsFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

