<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Document_Type_DocumentFlavorParamsOutputFilter extends Kaltura_Client_Document_Type_DocumentFlavorParamsOutputBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaDocumentFlavorParamsOutputFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

