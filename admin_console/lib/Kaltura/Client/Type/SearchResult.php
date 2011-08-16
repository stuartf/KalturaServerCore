<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_SearchResult extends Kaltura_Client_Type_Search
{
	public function getKalturaObjectType()
	{
		return 'KalturaSearchResult';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->id = (string)$xml->id;
		$this->title = (string)$xml->title;
		$this->thumbUrl = (string)$xml->thumbUrl;
		$this->description = (string)$xml->description;
		$this->tags = (string)$xml->tags;
		$this->url = (string)$xml->url;
		$this->sourceLink = (string)$xml->sourceLink;
		$this->credit = (string)$xml->credit;
		if(count($xml->licenseType))
			$this->licenseType = (int)$xml->licenseType;
		$this->flashPlaybackType = (string)$xml->flashPlaybackType;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $id = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $title = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $thumbUrl = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $description = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $tags = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $url = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $sourceLink = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $credit = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_LicenseType
	 */
	public $licenseType = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $flashPlaybackType = null;


}

