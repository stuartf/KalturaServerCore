<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_StorageExportJobData extends Kaltura_Client_Type_StorageJobData
{
	public function getKalturaObjectType()
	{
		return 'KalturaStorageExportJobData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->destFileSyncStoredPath = (string)$xml->destFileSyncStoredPath;
		if(!empty($xml->force))
			$this->force = true;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $destFileSyncStoredPath = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	public $force = null;


}

