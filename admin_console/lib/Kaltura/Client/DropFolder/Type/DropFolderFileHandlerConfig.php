<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_DropFolder_Type_DropFolderFileHandlerConfig extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaDropFolderFileHandlerConfig';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->handlerType = (string)$xml->handlerType;
	}
	/**
	 * 
	 *
	 * @var Kaltura_Client_DropFolder_Enum_DropFolderFileHandlerType
	 * @readonly
	 */
	public $handlerType = null;


}

