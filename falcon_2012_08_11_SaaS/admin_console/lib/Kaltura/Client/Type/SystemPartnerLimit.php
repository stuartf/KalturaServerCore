<?php
class Kaltura_Client_Type_SystemPartnerLimit extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaSystemPartnerLimit';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->type = (string)$xml->type;
		if(count($xml->max))
			$this->max = (int)$xml->max;
		if(count($xml->overagePrice))
			$this->overagePrice = (float)$xml->overagePrice;
	}
	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_SystemPartnerLimitType
	 */
	public $type = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $max = null;

	/**
	 * 
	 *
	 * @var float
	 */
	public $overagePrice = null;


}

