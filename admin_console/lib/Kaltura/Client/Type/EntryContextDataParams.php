<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_EntryContextDataParams extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaEntryContextDataParams';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->referrer = (string)$xml->referrer;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $referrer = null;


}

