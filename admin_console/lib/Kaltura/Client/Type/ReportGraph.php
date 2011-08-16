<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_ReportGraph extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaReportGraph';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->id = (string)$xml->id;
		$this->data = (string)$xml->data;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $id = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $data = null;


}

