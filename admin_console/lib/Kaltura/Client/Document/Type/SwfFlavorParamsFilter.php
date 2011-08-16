<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Document_Type_SwfFlavorParamsFilter extends Kaltura_Client_Document_Type_SwfFlavorParamsBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaSwfFlavorParamsFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

