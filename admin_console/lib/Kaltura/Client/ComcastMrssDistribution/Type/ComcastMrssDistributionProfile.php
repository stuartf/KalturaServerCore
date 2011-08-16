<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_ComcastMrssDistribution_Type_ComcastMrssDistributionProfile extends Kaltura_Client_ContentDistribution_Type_ConfigurableDistributionProfile
{
	public function getKalturaObjectType()
	{
		return 'KalturaComcastMrssDistributionProfile';
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
		$this->feedLastBuildDate = (string)$xml->feedLastBuildDate;
		$this->itemLink = (string)$xml->itemLink;
		if(empty($xml->cPlatformTvSeries))
			$this->cPlatformTvSeries = array();
		else
			$this->cPlatformTvSeries = Kaltura_Client_Client::unmarshalItem($xml->cPlatformTvSeries);
		$this->cPlatformTvSeriesField = (string)$xml->cPlatformTvSeriesField;
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
	public $feedLastBuildDate = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $itemLink = null;

	/**
	 * 
	 *
	 * @var array of KalturaKeyValue
	 */
	public $cPlatformTvSeries;

	/**
	 * 
	 *
	 * @var string
	 */
	public $cPlatformTvSeriesField = null;


}

