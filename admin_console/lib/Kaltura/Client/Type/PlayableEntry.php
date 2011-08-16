<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_PlayableEntry extends Kaltura_Client_Type_BaseEntry
{
	public function getKalturaObjectType()
	{
		return 'KalturaPlayableEntry';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->plays))
			$this->plays = (int)$xml->plays;
		if(count($xml->views))
			$this->views = (int)$xml->views;
		if(count($xml->width))
			$this->width = (int)$xml->width;
		if(count($xml->height))
			$this->height = (int)$xml->height;
		if(count($xml->duration))
			$this->duration = (int)$xml->duration;
		if(count($xml->msDuration))
			$this->msDuration = (int)$xml->msDuration;
		$this->durationType = (string)$xml->durationType;
	}
	/**
	 * Number of plays
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $plays = null;

	/**
	 * Number of views
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $views = null;

	/**
	 * The width in pixels
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $width = null;

	/**
	 * The height in pixels
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $height = null;

	/**
	 * The duration in seconds
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $duration = null;

	/**
	 * The duration in miliseconds
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $msDuration = null;

	/**
	 * The duration type (short for 0-4 mins, medium for 4-20 mins, long for 20+ mins)
	 * 
	 *
	 * @var Kaltura_Client_Enum_DurationType
	 * @readonly
	 */
	public $durationType = null;


}

