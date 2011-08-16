<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_BatchJobFilterExt extends Kaltura_Client_Type_BatchJobFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaBatchJobFilterExt';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->jobTypeAndSubTypeIn = (string)$xml->jobTypeAndSubTypeIn;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $jobTypeAndSubTypeIn = null;


}

