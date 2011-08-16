<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_FileSyncResource extends Kaltura_Client_Type_ContentResource
{
	public function getKalturaObjectType()
	{
		return 'KalturaFileSyncResource';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->fileSyncObjectType))
			$this->fileSyncObjectType = (int)$xml->fileSyncObjectType;
		if(count($xml->objectSubType))
			$this->objectSubType = (int)$xml->objectSubType;
		$this->objectId = (string)$xml->objectId;
		$this->version = (string)$xml->version;
	}
	/**
	 * The object type of the file sync object 
	 *
	 * @var int
	 */
	public $fileSyncObjectType = null;

	/**
	 * The object sub-type of the file sync object 
	 *
	 * @var int
	 */
	public $objectSubType = null;

	/**
	 * The object id of the file sync object 
	 *
	 * @var string
	 */
	public $objectId = null;

	/**
	 * The version of the file sync object 
	 *
	 * @var string
	 */
	public $version = null;


}

