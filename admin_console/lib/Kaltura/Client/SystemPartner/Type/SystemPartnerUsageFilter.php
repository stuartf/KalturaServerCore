<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_SystemPartner_Type_SystemPartnerUsageFilter extends Kaltura_Client_Type_Filter
{
	public function getKalturaObjectType()
	{
		return 'KalturaSystemPartnerUsageFilter';
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
	}
	/**
	 * Date range from
	 * 
	 *
	 * @var int
	 */
	public $fromDate = null;

	/**
	 * Date range to
	 * 
	 *
	 * @var int
	 */
	public $toDate = null;


}

