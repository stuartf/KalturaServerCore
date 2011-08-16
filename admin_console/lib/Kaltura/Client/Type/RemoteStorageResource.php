<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_RemoteStorageResource extends Kaltura_Client_Type_UrlResource
{
	public function getKalturaObjectType()
	{
		return 'KalturaRemoteStorageResource';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->storageProfileId))
			$this->storageProfileId = (int)$xml->storageProfileId;
	}
	/**
	 * ID of storage profile to be associated with the created file sync, used for file serving URL composing. 
	 *
	 * @var int
	 */
	public $storageProfileId = null;


}

