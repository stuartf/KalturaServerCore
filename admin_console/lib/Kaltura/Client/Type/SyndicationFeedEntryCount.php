<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_SyndicationFeedEntryCount extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaSyndicationFeedEntryCount';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->totalEntryCount))
			$this->totalEntryCount = (int)$xml->totalEntryCount;
		if(count($xml->actualEntryCount))
			$this->actualEntryCount = (int)$xml->actualEntryCount;
		if(count($xml->requireTranscodingCount))
			$this->requireTranscodingCount = (int)$xml->requireTranscodingCount;
	}
	/**
	 * the total count of entries that should appear in the feed without flavor filtering
	 *
	 * @var int
	 */
	public $totalEntryCount = null;

	/**
	 * count of entries that will appear in the feed (including all relevant filters)
	 *
	 * @var int
	 */
	public $actualEntryCount = null;

	/**
	 * count of entries that requires transcoding in order to be included in feed
	 *
	 * @var int
	 */
	public $requireTranscodingCount = null;


}

