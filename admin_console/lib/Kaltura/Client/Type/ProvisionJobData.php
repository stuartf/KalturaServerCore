<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_ProvisionJobData extends Kaltura_Client_Type_JobData
{
	public function getKalturaObjectType()
	{
		return 'KalturaProvisionJobData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->streamID = (string)$xml->streamID;
		$this->backupStreamID = (string)$xml->backupStreamID;
		$this->rtmp = (string)$xml->rtmp;
		$this->encoderIP = (string)$xml->encoderIP;
		$this->backupEncoderIP = (string)$xml->backupEncoderIP;
		$this->encoderPassword = (string)$xml->encoderPassword;
		$this->encoderUsername = (string)$xml->encoderUsername;
		if(count($xml->endDate))
			$this->endDate = (int)$xml->endDate;
		$this->returnVal = (string)$xml->returnVal;
		if(count($xml->mediaType))
			$this->mediaType = (int)$xml->mediaType;
		$this->primaryBroadcastingUrl = (string)$xml->primaryBroadcastingUrl;
		$this->secondaryBroadcastingUrl = (string)$xml->secondaryBroadcastingUrl;
		$this->streamName = (string)$xml->streamName;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $streamID = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $backupStreamID = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $rtmp = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $encoderIP = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $backupEncoderIP = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $encoderPassword = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $encoderUsername = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $endDate = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $returnVal = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $mediaType = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $primaryBroadcastingUrl = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $secondaryBroadcastingUrl = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $streamName = null;


}

