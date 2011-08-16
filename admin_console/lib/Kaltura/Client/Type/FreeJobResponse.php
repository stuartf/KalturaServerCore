<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_FreeJobResponse extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaFreeJobResponse';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(!empty($xml->job))
			$this->job = Kaltura_Client_Client::unmarshalItem($xml->job);
		$this->jobType = (string)$xml->jobType;
		if(count($xml->queueSize))
			$this->queueSize = (int)$xml->queueSize;
	}
	/**
	 * 
	 *
	 * @var Kaltura_Client_Type_BatchJob
	 * @readonly
	 */
	public $job;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_BatchJobType
	 * @readonly
	 */
	public $jobType = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $queueSize = null;


}

