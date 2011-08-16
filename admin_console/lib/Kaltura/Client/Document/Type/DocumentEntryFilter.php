<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Document_Type_DocumentEntryFilter extends Kaltura_Client_Document_Type_DocumentEntryBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaDocumentEntryFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

