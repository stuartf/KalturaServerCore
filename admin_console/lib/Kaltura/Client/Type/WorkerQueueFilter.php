<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_WorkerQueueFilter extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaWorkerQueueFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->schedulerId))
			$this->schedulerId = (int)$xml->schedulerId;
		if(count($xml->workerId))
			$this->workerId = (int)$xml->workerId;
		$this->jobType = (string)$xml->jobType;
		if(!empty($xml->filter))
			$this->filter = Kaltura_Client_Client::unmarshalItem($xml->filter);
	}
	/**
	 * 
	 *
	 * @var int
	 */
	public $schedulerId = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $workerId = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_BatchJobType
	 */
	public $jobType = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Type_BatchJobFilter
	 */
	public $filter;


}

