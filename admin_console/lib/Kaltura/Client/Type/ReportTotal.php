<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_ReportTotal extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaReportTotal';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->header = (string)$xml->header;
		$this->data = (string)$xml->data;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $header = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $data = null;


}

