<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_MediaEntryFilterForPlaylist extends Kaltura_Client_Type_MediaEntryFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaMediaEntryFilterForPlaylist';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->limit))
			$this->limit = (int)$xml->limit;
	}
	/**
	 * 
	 *
	 * @var int
	 */
	public $limit = null;


}

