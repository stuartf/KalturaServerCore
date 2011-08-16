<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_ContentDistribution_Type_DistributionFetchReportJobData extends Kaltura_Client_ContentDistribution_Type_DistributionJobData
{
	public function getKalturaObjectType()
	{
		return 'KalturaDistributionFetchReportJobData';
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
	}
	/**
	 * 
	 *
	 * @var int
	 */
	public $plays = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $views = null;


}

