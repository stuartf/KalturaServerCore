<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_ApiActionPermissionItem extends Kaltura_Client_Type_PermissionItem
{
	public function getKalturaObjectType()
	{
		return 'KalturaApiActionPermissionItem';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->service = (string)$xml->service;
		$this->action = (string)$xml->action;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $service = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $action = null;


}

