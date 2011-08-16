<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Document_Type_PdfFlavorParamsFilter extends Kaltura_Client_Document_Type_PdfFlavorParamsBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaPdfFlavorParamsFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

