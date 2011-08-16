<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_ITunesSyndicationFeed extends Kaltura_Client_Type_BaseSyndicationFeed
{
	public function getKalturaObjectType()
	{
		return 'KalturaITunesSyndicationFeed';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->feedDescription = (string)$xml->feedDescription;
		$this->language = (string)$xml->language;
		$this->feedLandingPage = (string)$xml->feedLandingPage;
		$this->ownerName = (string)$xml->ownerName;
		$this->ownerEmail = (string)$xml->ownerEmail;
		$this->feedImageUrl = (string)$xml->feedImageUrl;
		$this->category = (string)$xml->category;
		$this->adultContent = (string)$xml->adultContent;
		$this->feedAuthor = (string)$xml->feedAuthor;
	}
	/**
	 * feed description
	 * 
	 *
	 * @var string
	 */
	public $feedDescription = null;

	/**
	 * feed language
	 * 
	 *
	 * @var string
	 */
	public $language = null;

	/**
	 * feed landing page (i.e publisher website)
	 * 
	 *
	 * @var string
	 */
	public $feedLandingPage = null;

	/**
	 * author/publisher name
	 * 
	 *
	 * @var string
	 */
	public $ownerName = null;

	/**
	 * publisher email
	 * 
	 *
	 * @var string
	 */
	public $ownerEmail = null;

	/**
	 * podcast thumbnail
	 * 
	 *
	 * @var string
	 */
	public $feedImageUrl = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_ITunesSyndicationFeedCategories
	 * @readonly
	 */
	public $category = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_ITunesSyndicationFeedAdultValues
	 */
	public $adultContent = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $feedAuthor = null;


}

