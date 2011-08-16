<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_ReportInputFilter extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaReportInputFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->fromDate))
			$this->fromDate = (int)$xml->fromDate;
		if(count($xml->toDate))
			$this->toDate = (int)$xml->toDate;
		$this->keywords = (string)$xml->keywords;
		if(!empty($xml->searchInTags))
			$this->searchInTags = true;
		if(!empty($xml->searchInAdminTags))
			$this->searchInAdminTags = true;
		$this->categories = (string)$xml->categories;
		if(count($xml->timeZoneOffset))
			$this->timeZoneOffset = (int)$xml->timeZoneOffset;
	}
	/**
	 * 
	 *
	 * @var int
	 */
	public $fromDate = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $toDate = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $keywords = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	public $searchInTags = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	public $searchInAdminTags = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $categories = null;

	/**
	 * time zone offset in minutes
	 *
	 * @var int
	 */
	public $timeZoneOffset = null;


}

