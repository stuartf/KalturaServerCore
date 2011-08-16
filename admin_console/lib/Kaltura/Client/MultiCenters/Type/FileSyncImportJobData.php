<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_MultiCenters_Type_FileSyncImportJobData extends Kaltura_Client_Type_JobData
{
	public function getKalturaObjectType()
	{
		return 'KalturaFileSyncImportJobData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->sourceUrl = (string)$xml->sourceUrl;
		$this->filesyncId = (string)$xml->filesyncId;
		$this->tmpFilePath = (string)$xml->tmpFilePath;
		$this->destFilePath = (string)$xml->destFilePath;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $sourceUrl = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $filesyncId = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $tmpFilePath = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $destFilePath = null;


}

