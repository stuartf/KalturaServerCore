<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_BatchJobResponse extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaBatchJobResponse';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(!empty($xml->batchJob))
			$this->batchJob = Kaltura_Client_Client::unmarshalItem($xml->batchJob);
		if(empty($xml->childBatchJobs))
			$this->childBatchJobs = array();
		else
			$this->childBatchJobs = Kaltura_Client_Client::unmarshalItem($xml->childBatchJobs);
	}
	/**
	 * The main batch job
	 * 
	 *
	 * @var Kaltura_Client_Type_BatchJob
	 */
	public $batchJob;

	/**
	 * All batch jobs that reference the main job as root
	 * 
	 *
	 * @var array of KalturaBatchJob
	 */
	public $childBatchJobs;


}

