<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_YahooSyndicationFeed extends Kaltura_Client_Type_BaseSyndicationFeed
{
	public function getKalturaObjectType()
	{
		return 'KalturaYahooSyndicationFeed';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->category = (string)$xml->category;
		$this->adultContent = (string)$xml->adultContent;
		$this->feedDescription = (string)$xml->feedDescription;
		$this->feedLandingPage = (string)$xml->feedLandingPage;
	}
	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_YahooSyndicationFeedCategories
	 * @readonly
	 */
	public $category = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_YahooSyndicationFeedAdultValues
	 */
	public $adultContent = null;

	/**
	 * feed description
	 * 
	 *
	 * @var string
	 */
	public $feedDescription = null;

	/**
	 * feed landing page (i.e publisher website)
	 * 
	 *
	 * @var string
	 */
	public $feedLandingPage = null;


}

