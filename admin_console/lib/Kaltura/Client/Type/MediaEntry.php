<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_MediaEntry extends Kaltura_Client_Type_PlayableEntry
{
	public function getKalturaObjectType()
	{
		return 'KalturaMediaEntry';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->mediaType))
			$this->mediaType = (int)$xml->mediaType;
		$this->conversionQuality = (string)$xml->conversionQuality;
		if(count($xml->sourceType))
			$this->sourceType = (int)$xml->sourceType;
		if(count($xml->searchProviderType))
			$this->searchProviderType = (int)$xml->searchProviderType;
		$this->searchProviderId = (string)$xml->searchProviderId;
		$this->creditUserName = (string)$xml->creditUserName;
		$this->creditUrl = (string)$xml->creditUrl;
		if(count($xml->mediaDate))
			$this->mediaDate = (int)$xml->mediaDate;
		$this->dataUrl = (string)$xml->dataUrl;
		$this->flavorParamsIds = (string)$xml->flavorParamsIds;
	}
	/**
	 * The media type of the entry
	 * 
	 *
	 * @var Kaltura_Client_Enum_MediaType
	 * @insertonly
	 */
	public $mediaType = null;

	/**
	 * Override the default conversion quality
	 * DEPRECATED - use conversionProfileId instead
	 *
	 * @var string
	 * @insertonly
	 */
	public $conversionQuality = null;

	/**
	 * The source type of the entry 
	 *
	 * @var Kaltura_Client_Enum_SourceType
	 * @insertonly
	 */
	public $sourceType = null;

	/**
	 * The search provider type used to import this entry
	 *
	 * @var Kaltura_Client_Enum_SearchProviderType
	 * @insertonly
	 */
	public $searchProviderType = null;

	/**
	 * The ID of the media in the importing site
	 *
	 * @var string
	 * @insertonly
	 */
	public $searchProviderId = null;

	/**
	 * The user name used for credits
	 *
	 * @var string
	 */
	public $creditUserName = null;

	/**
	 * The URL for credits
	 *
	 * @var string
	 */
	public $creditUrl = null;

	/**
	 * The media date extracted from EXIF data (For images) as Unix timestamp (In seconds)
	 *
	 * @var int
	 * @readonly
	 */
	public $mediaDate = null;

	/**
	 * The URL used for playback. This is not the download URL.
	 *
	 * @var string
	 * @readonly
	 */
	public $dataUrl = null;

	/**
	 * Comma separated flavor params ids that exists for this media entry
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $flavorParamsIds = null;


}

