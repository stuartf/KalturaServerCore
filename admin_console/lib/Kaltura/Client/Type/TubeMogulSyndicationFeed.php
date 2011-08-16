<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_TubeMogulSyndicationFeed extends Kaltura_Client_Type_BaseSyndicationFeed
{
	public function getKalturaObjectType()
	{
		return 'KalturaTubeMogulSyndicationFeed';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->category = (string)$xml->category;
	}
	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_TubeMogulSyndicationFeedCategories
	 * @readonly
	 */
	public $category = null;


}

