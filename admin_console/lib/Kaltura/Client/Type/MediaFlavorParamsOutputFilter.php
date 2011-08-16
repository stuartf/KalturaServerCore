<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_MediaFlavorParamsOutputFilter extends Kaltura_Client_Type_MediaFlavorParamsOutputBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaMediaFlavorParamsOutputFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

