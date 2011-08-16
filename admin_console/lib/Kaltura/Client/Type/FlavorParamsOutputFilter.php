<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_FlavorParamsOutputFilter extends Kaltura_Client_Type_FlavorParamsOutputBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaFlavorParamsOutputFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

