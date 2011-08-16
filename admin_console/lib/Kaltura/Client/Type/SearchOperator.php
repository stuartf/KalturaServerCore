<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_SearchOperator extends Kaltura_Client_Type_SearchItem
{
	public function getKalturaObjectType()
	{
		return 'KalturaSearchOperator';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->type))
			$this->type = (int)$xml->type;
		if(empty($xml->items))
			$this->items = array();
		else
			$this->items = Kaltura_Client_Client::unmarshalItem($xml->items);
	}
	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_SearchOperatorType
	 */
	public $type = null;

	/**
	 * 
	 *
	 * @var array of KalturaSearchItem
	 */
	public $items;


}

