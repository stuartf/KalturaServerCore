<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_Filter extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->orderBy = (string)$xml->orderBy;
		if(!empty($xml->advancedSearch))
			$this->advancedSearch = Kaltura_Client_Client::unmarshalItem($xml->advancedSearch);
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $orderBy = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Type_SearchItem
	 */
	public $advancedSearch;


}

