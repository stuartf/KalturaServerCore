<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_FilterPager extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaFilterPager';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->pageSize))
			$this->pageSize = (int)$xml->pageSize;
		if(count($xml->pageIndex))
			$this->pageIndex = (int)$xml->pageIndex;
	}
	/**
	 * The number of objects to retrieve. (Default is 30, maximum page size is 500).
	 * 
	 *
	 * @var int
	 */
	public $pageSize = null;

	/**
	 * The page number for which {pageSize} of objects should be retrieved (Default is 1).
	 * 
	 *
	 * @var int
	 */
	public $pageIndex = null;


}

