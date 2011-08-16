<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_SearchComparableCondition extends Kaltura_Client_Type_SearchCondition
{
	public function getKalturaObjectType()
	{
		return 'KalturaSearchComparableCondition';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->comparison))
			$this->comparison = (int)$xml->comparison;
	}
	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_SearchConditionComparison
	 */
	public $comparison = null;


}

