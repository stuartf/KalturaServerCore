<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_ConvertProfileJobData extends Kaltura_Client_Type_JobData
{
	public function getKalturaObjectType()
	{
		return 'KalturaConvertProfileJobData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->inputFileSyncLocalPath = (string)$xml->inputFileSyncLocalPath;
		if(count($xml->thumbHeight))
			$this->thumbHeight = (int)$xml->thumbHeight;
		if(count($xml->thumbBitrate))
			$this->thumbBitrate = (int)$xml->thumbBitrate;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $inputFileSyncLocalPath = null;

	/**
	 * The height of last created thumbnail, will be used to comapare if this thumbnail is the best we can have
	 * 
	 *
	 * @var int
	 */
	public $thumbHeight = null;

	/**
	 * The bit rate of last created thumbnail, will be used to comapare if this thumbnail is the best we can have
	 * 
	 *
	 * @var int
	 */
	public $thumbBitrate = null;


}

