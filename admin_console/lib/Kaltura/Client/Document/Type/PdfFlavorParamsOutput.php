<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Document_Type_PdfFlavorParamsOutput extends Kaltura_Client_Type_FlavorParamsOutput
{
	public function getKalturaObjectType()
	{
		return 'KalturaPdfFlavorParamsOutput';
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

