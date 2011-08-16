<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_GoogleVideoSyndicationFeed extends Kaltura_Client_Type_BaseSyndicationFeed
{
	public function getKalturaObjectType()
	{
		return 'KalturaGoogleVideoSyndicationFeed';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->adultContent = (string)$xml->adultContent;
	}
	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_GoogleSyndicationFeedAdultValues
	 */
	public $adultContent = null;


}

