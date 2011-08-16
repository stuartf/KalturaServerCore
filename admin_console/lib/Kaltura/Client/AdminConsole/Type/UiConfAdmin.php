<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_AdminConsole_Type_UiConfAdmin extends Kaltura_Client_Type_UiConf
{
	public function getKalturaObjectType()
	{
		return 'KalturaUiConfAdmin';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(!empty($xml->isPublic))
			$this->isPublic = true;
	}
	/**
	 * 
	 *
	 * @var bool
	 */
	public $isPublic = null;


}

