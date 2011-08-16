<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_Type_PlayableEntryBaseFilter extends Kaltura_Client_Type_BaseEntryFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaPlayableEntryBaseFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->durationLessThan))
			$this->durationLessThan = (int)$xml->durationLessThan;
		if(count($xml->durationGreaterThan))
			$this->durationGreaterThan = (int)$xml->durationGreaterThan;
		if(count($xml->durationLessThanOrEqual))
			$this->durationLessThanOrEqual = (int)$xml->durationLessThanOrEqual;
		if(count($xml->durationGreaterThanOrEqual))
			$this->durationGreaterThanOrEqual = (int)$xml->durationGreaterThanOrEqual;
		if(count($xml->msDurationLessThan))
			$this->msDurationLessThan = (int)$xml->msDurationLessThan;
		if(count($xml->msDurationGreaterThan))
			$this->msDurationGreaterThan = (int)$xml->msDurationGreaterThan;
		if(count($xml->msDurationLessThanOrEqual))
			$this->msDurationLessThanOrEqual = (int)$xml->msDurationLessThanOrEqual;
		if(count($xml->msDurationGreaterThanOrEqual))
			$this->msDurationGreaterThanOrEqual = (int)$xml->msDurationGreaterThanOrEqual;
		$this->durationTypeMatchOr = (string)$xml->durationTypeMatchOr;
	}
	/**
	 * 
	 *
	 * @var int
	 */
	public $durationLessThan = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $durationGreaterThan = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $durationLessThanOrEqual = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $durationGreaterThanOrEqual = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $msDurationLessThan = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $msDurationGreaterThan = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $msDurationLessThanOrEqual = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $msDurationGreaterThanOrEqual = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $durationTypeMatchOr = null;


}

