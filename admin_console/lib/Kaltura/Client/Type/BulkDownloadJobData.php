<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_BulkDownloadJobData extends Kaltura_Client_Type_JobData
{
	public function getKalturaObjectType()
	{
		return 'KalturaBulkDownloadJobData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->entryIds = (string)$xml->entryIds;
		if(count($xml->flavorParamsId))
			$this->flavorParamsId = (int)$xml->flavorParamsId;
		$this->puserId = (string)$xml->puserId;
	}
	/**
	 * Comma separated list of entry ids
	 * 
	 *
	 * @var string
	 */
	public $entryIds = null;

	/**
	 * Flavor params id to use for conversion
	 * 
	 *
	 * @var int
	 */
	public $flavorParamsId = null;

	/**
	 * The id of the requesting user
	 * 
	 *
	 * @var string
	 */
	public $puserId = null;


}

