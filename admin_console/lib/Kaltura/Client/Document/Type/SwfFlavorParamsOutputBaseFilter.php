<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_Document_Type_SwfFlavorParamsOutputBaseFilter extends Kaltura_Client_Type_FlavorParamsOutputFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaSwfFlavorParamsOutputBaseFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

