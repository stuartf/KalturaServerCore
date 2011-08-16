<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_Document_Type_DocumentEntryBaseFilter extends Kaltura_Client_Type_BaseEntryFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaDocumentEntryBaseFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->documentTypeEqual))
			$this->documentTypeEqual = (int)$xml->documentTypeEqual;
		$this->documentTypeIn = (string)$xml->documentTypeIn;
	}
	/**
	 * 
	 *
	 * @var Kaltura_Client_Document_Enum_DocumentType
	 */
	public $documentTypeEqual = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $documentTypeIn = null;


}

