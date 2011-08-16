<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_ApiParameterPermissionItem extends Kaltura_Client_Type_PermissionItem
{
	public function getKalturaObjectType()
	{
		return 'KalturaApiParameterPermissionItem';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->object = (string)$xml->object;
		$this->parameter = (string)$xml->parameter;
		$this->action = (string)$xml->action;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $object = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $parameter = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_ApiParameterPermissionItemAction
	 */
	public $action = null;


}

