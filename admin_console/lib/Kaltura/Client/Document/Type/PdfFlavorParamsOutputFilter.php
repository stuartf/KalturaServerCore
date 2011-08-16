<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Document_Type_PdfFlavorParamsOutputFilter extends Kaltura_Client_Document_Type_PdfFlavorParamsOutputBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaPdfFlavorParamsOutputFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

