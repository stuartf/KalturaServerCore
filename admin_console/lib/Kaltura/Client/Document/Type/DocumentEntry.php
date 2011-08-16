<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Document_Type_DocumentEntry extends Kaltura_Client_Type_BaseEntry
{
	public function getKalturaObjectType()
	{
		return 'KalturaDocumentEntry';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->documentType))
			$this->documentType = (int)$xml->documentType;
	}
	/**
	 * The type of the document
	 *
	 * @var Kaltura_Client_Document_Enum_DocumentType
	 * @insertonly
	 */
	public $documentType = null;


}

