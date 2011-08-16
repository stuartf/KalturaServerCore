<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_ReportTable extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaReportTable';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->header = (string)$xml->header;
		$this->data = (string)$xml->data;
		if(count($xml->totalCount))
			$this->totalCount = (int)$xml->totalCount;
	}
	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $header = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $data = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $totalCount = null;


}

