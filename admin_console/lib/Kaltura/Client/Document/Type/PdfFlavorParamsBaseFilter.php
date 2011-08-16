<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_Document_Type_PdfFlavorParamsBaseFilter extends Kaltura_Client_Type_FlavorParamsFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaPdfFlavorParamsBaseFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

