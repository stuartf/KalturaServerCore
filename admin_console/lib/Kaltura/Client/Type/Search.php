<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_Search extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaSearch';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->keyWords = (string)$xml->keyWords;
		if(count($xml->searchSource))
			$this->searchSource = (int)$xml->searchSource;
		if(count($xml->mediaType))
			$this->mediaType = (int)$xml->mediaType;
		$this->extraData = (string)$xml->extraData;
		$this->authData = (string)$xml->authData;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $keyWords = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_SearchProviderType
	 */
	public $searchSource = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_MediaType
	 */
	public $mediaType = null;

	/**
	 * Use this field to pass dynamic data for searching
	 * For example - if you set this field to "mymovies_$partner_id"
	 * The $partner_id will be automatically replcaed with your real partner Id
	 * 
	 *
	 * @var string
	 */
	public $extraData = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $authData = null;


}

