<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Document_Type_DocumentFlavorParams extends Kaltura_Client_Type_FlavorParams
{
	public function getKalturaObjectType()
	{
		return 'KalturaDocumentFlavorParams';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

