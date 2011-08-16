<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_DropFolder_Type_DropFolderFileResource extends Kaltura_Client_Type_DataCenterContentResource
{
	public function getKalturaObjectType()
	{
		return 'KalturaDropFolderFileResource';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->dropFolderFileId))
			$this->dropFolderFileId = (int)$xml->dropFolderFileId;
	}
	/**
	 * Id of the drop folder file object
	 *
	 * @var int
	 */
	public $dropFolderFileId = null;


}

