<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_LiveStreamEntry extends Kaltura_Client_Type_MediaEntry
{
	public function getKalturaObjectType()
	{
		return 'KalturaLiveStreamEntry';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->offlineMessage = (string)$xml->offlineMessage;
		$this->streamRemoteId = (string)$xml->streamRemoteId;
		$this->streamRemoteBackupId = (string)$xml->streamRemoteBackupId;
		if(empty($xml->bitrates))
			$this->bitrates = array();
		else
			$this->bitrates = Kaltura_Client_Client::unmarshalItem($xml->bitrates);
		$this->primaryBroadcastingUrl = (string)$xml->primaryBroadcastingUrl;
		$this->secondaryBroadcastingUrl = (string)$xml->secondaryBroadcastingUrl;
		$this->streamName = (string)$xml->streamName;
	}
	/**
	 * The message to be presented when the stream is offline
	 * 
	 *
	 * @var string
	 */
	public $offlineMessage = null;

	/**
	 * The stream id as provided by the provider
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $streamRemoteId = null;

	/**
	 * The backup stream id as provided by the provider
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $streamRemoteBackupId = null;

	/**
	 * Array of supported bitrates
	 * 
	 *
	 * @var array of KalturaLiveStreamBitrate
	 */
	public $bitrates;

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

