<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Document_Type_DocumentFlavorParamsOutput extends Kaltura_Client_Type_FlavorParamsOutput
{
	public function getKalturaObjectType()
	{
		return 'KalturaDocumentFlavorParamsOutput';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

