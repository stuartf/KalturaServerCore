<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_TvComDistribution_Type_TVComDistributionProfile extends Kaltura_Client_ContentDistribution_Type_ConfigurableDistributionProfile
{
	public function getKalturaObjectType()
	{
		return 'KalturaTVComDistributionProfile';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->metadataProfileId))
			$this->metadataProfileId = (int)$xml->metadataProfileId;
		$this->feedUrl = (string)$xml->feedUrl;
		$this->feedTitle = (string)$xml->feedTitle;
		$this->feedLink = (string)$xml->feedLink;
		$this->feedDescription = (string)$xml->feedDescription;
		$this->feedLanguage = (string)$xml->feedLanguage;
		$this->feedCopyright = (string)$xml->feedCopyright;
		$this->feedImageTitle = (string)$xml->feedImageTitle;
		$this->feedImageUrl = (string)$xml->feedImageUrl;
		$this->feedImageLink = (string)$xml->feedImageLink;
		if(count($xml->feedImageWidth))
			$this->feedImageWidth = (int)$xml->feedImageWidth;
		if(count($xml->feedImageHeight))
			$this->feedImageHeight = (int)$xml->feedImageHeight;
	}
	/**
	 * 
	 *
	 * @var int
	 */
	public $metadataProfileId = null;

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
	 * @var string
	 */
	public $feedTitle = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $feedLink = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $feedDescription = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $feedLanguage = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $feedCopyright = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $feedImageTitle = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $feedImageUrl = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $feedImageLink = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $feedImageWidth = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $feedImageHeight = null;


}

