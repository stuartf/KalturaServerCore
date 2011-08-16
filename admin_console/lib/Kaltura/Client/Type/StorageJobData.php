<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_StorageJobData extends Kaltura_Client_Type_JobData
{
	public function getKalturaObjectType()
	{
		return 'KalturaStorageJobData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->serverUrl = (string)$xml->serverUrl;
		$this->serverUsername = (string)$xml->serverUsername;
		$this->serverPassword = (string)$xml->serverPassword;
		if(!empty($xml->ftpPassiveMode))
			$this->ftpPassiveMode = true;
		$this->srcFileSyncLocalPath = (string)$xml->srcFileSyncLocalPath;
		$this->srcFileSyncId = (string)$xml->srcFileSyncId;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $serverUrl = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $serverUsername = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $serverPassword = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	public $ftpPassiveMode = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $srcFileSyncLocalPath = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $srcFileSyncId = null;


}

