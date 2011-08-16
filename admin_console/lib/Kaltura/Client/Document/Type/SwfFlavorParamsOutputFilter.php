<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Document_Type_SwfFlavorParamsOutputFilter extends Kaltura_Client_Document_Type_SwfFlavorParamsOutputBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaSwfFlavorParamsOutputFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

