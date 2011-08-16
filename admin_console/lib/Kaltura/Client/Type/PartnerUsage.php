<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_PartnerUsage extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaPartnerUsage';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->hostingGB))
			$this->hostingGB = (float)$xml->hostingGB;
		if(count($xml->Percent))
			$this->Percent = (float)$xml->Percent;
		if(count($xml->packageBW))
			$this->packageBW = (int)$xml->packageBW;
		if(count($xml->usageGB))
			$this->usageGB = (int)$xml->usageGB;
		if(count($xml->reachedLimitDate))
			$this->reachedLimitDate = (int)$xml->reachedLimitDate;
		$this->usageGraph = (string)$xml->usageGraph;
	}
	/**
	 * Partner total hosting in GB on the disk
	 * 
	 *
	 * @var float
	 * @readonly
	 */
	public $hostingGB = null;

	/**
	 * percent of usage out of partner's package. if usageGB is 5 and package is 10GB, this value will be 50
	 * 
	 *
	 * @var float
	 * @readonly
	 */
	public $Percent = null;

	/**
	 * package total BW - actually this is usage, which represents BW+storage
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $packageBW = null;

	/**
	 * total usage in GB - including bandwidth and storage
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $usageGB = null;

	/**
	 * date when partner reached the limit of his package (timestamp)
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $reachedLimitDate = null;

	/**
	 * a semi-colon separated list of comma-separated key-values to represent a usage graph.
	 * keys could be 1-12 for a year view (1,1.2;2,1.1;3,0.9;...;12,1.4;)
	 * keys could be 1-[28,29,30,31] depending on the requested month, for a daily view in a given month (1,0.4;2,0.2;...;31,0.1;)
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $usageGraph = null;


}

