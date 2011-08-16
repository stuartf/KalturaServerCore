<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_Type_BaseSyndicationFeed extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaBaseSyndicationFeed';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->id = (string)$xml->id;
		$this->feedUrl = (string)$xml->feedUrl;
		if(count($xml->partnerId))
			$this->partnerId = (int)$xml->partnerId;
		$this->playlistId = (string)$xml->playlistId;
		$this->name = (string)$xml->name;
		if(count($xml->status))
			$this->status = (int)$xml->status;
		if(count($xml->type))
			$this->type = (int)$xml->type;
		$this->landingPage = (string)$xml->landingPage;
		if(count($xml->createdAt))
			$this->createdAt = (int)$xml->createdAt;
		if(!empty($xml->allowEmbed))
			$this->allowEmbed = true;
		if(count($xml->playerUiconfId))
			$this->playerUiconfId = (int)$xml->playerUiconfId;
		if(count($xml->flavorParamId))
			$this->flavorParamId = (int)$xml->flavorParamId;
		if(!empty($xml->transcodeExistingContent))
			$this->transcodeExistingContent = true;
		if(!empty($xml->addToDefaultConversionProfile))
			$this->addToDefaultConversionProfile = true;
		$this->categories = (string)$xml->categories;
	}
	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $id = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $feedUrl = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $partnerId = null;

	/**
	 * link a playlist that will set what content the feed will include
	 * if empty, all content will be included in feed
	 * 
	 *
	 * @var string
	 */
	public $playlistId = null;

	/**
	 * feed name
	 * 
	 *
	 * @var string
	 */
	public $name = null;

	/**
	 * feed status
	 * 
	 *
	 * @var Kaltura_Client_Enum_SyndicationFeedStatus
	 * @readonly
	 */
	public $status = null;

	/**
	 * feed type
	 * 
	 *
	 * @var Kaltura_Client_Enum_SyndicationFeedType
	 * @insertonly
	 */
	public $type = null;

	/**
	 * Base URL for each video, on the partners site
	 * This is required by all syndication types.
	 *
	 * @var string
	 */
	public $landingPage = null;

	/**
	 * Creation date as Unix timestamp (In seconds)
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $createdAt = null;

	/**
	 * allow_embed tells google OR yahoo weather to allow embedding the video on google OR yahoo video results
	 * or just to provide a link to the landing page.
	 * it is applied on the video-player_loc property in the XML (google)
	 * and addes media-player tag (yahoo)
	 *
	 * @var bool
	 */
	public $allowEmbed = null;

	/**
	 * Select a uiconf ID as player skin to include in the kwidget url
	 *
	 * @var int
	 */
	public $playerUiconfId = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $flavorParamId = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	public $transcodeExistingContent = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	public $addToDefaultConversionProfile = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $categories = null;


}

