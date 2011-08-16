<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_Type_MediaEntryBaseFilter extends Kaltura_Client_Type_PlayableEntryFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaMediaEntryBaseFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->mediaTypeEqual))
			$this->mediaTypeEqual = (int)$xml->mediaTypeEqual;
		$this->mediaTypeIn = (string)$xml->mediaTypeIn;
		if(count($xml->mediaDateGreaterThanOrEqual))
			$this->mediaDateGreaterThanOrEqual = (int)$xml->mediaDateGreaterThanOrEqual;
		if(count($xml->mediaDateLessThanOrEqual))
			$this->mediaDateLessThanOrEqual = (int)$xml->mediaDateLessThanOrEqual;
		$this->flavorParamsIdsMatchOr = (string)$xml->flavorParamsIdsMatchOr;
		$this->flavorParamsIdsMatchAnd = (string)$xml->flavorParamsIdsMatchAnd;
	}
	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_MediaType
	 */
	public $mediaTypeEqual = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $mediaTypeIn = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $mediaDateGreaterThanOrEqual = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $mediaDateLessThanOrEqual = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $flavorParamsIdsMatchOr = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $flavorParamsIdsMatchAnd = null;


}

