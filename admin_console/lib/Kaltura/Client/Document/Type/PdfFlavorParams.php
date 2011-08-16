<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Document_Type_PdfFlavorParams extends Kaltura_Client_Type_FlavorParams
{
	public function getKalturaObjectType()
	{
		return 'KalturaPdfFlavorParams';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(!empty($xml->readonly))
			$this->readonly = true;
	}
	/**
	 * 
	 *
	 * @var bool
	 */
	public $readonly = null;


}

