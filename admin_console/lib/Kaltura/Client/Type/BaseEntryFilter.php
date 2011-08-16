<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_BaseEntryFilter extends Kaltura_Client_Type_BaseEntryBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaBaseEntryFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->freeText = (string)$xml->freeText;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $freeText = null;


}

