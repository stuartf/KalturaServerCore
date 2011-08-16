<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_ConvartableJobData extends Kaltura_Client_Type_JobData
{
	public function getKalturaObjectType()
	{
		return 'KalturaConvartableJobData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->srcFileSyncLocalPath = (string)$xml->srcFileSyncLocalPath;
		$this->actualSrcFileSyncLocalPath = (string)$xml->actualSrcFileSyncLocalPath;
		$this->srcFileSyncRemoteUrl = (string)$xml->srcFileSyncRemoteUrl;
		if(count($xml->engineVersion))
			$this->engineVersion = (int)$xml->engineVersion;
		if(count($xml->flavorParamsOutputId))
			$this->flavorParamsOutputId = (int)$xml->flavorParamsOutputId;
		if(!empty($xml->flavorParamsOutput))
			$this->flavorParamsOutput = Kaltura_Client_Client::unmarshalItem($xml->flavorParamsOutput);
		if(count($xml->mediaInfoId))
			$this->mediaInfoId = (int)$xml->mediaInfoId;
		if(count($xml->currentOperationSet))
			$this->currentOperationSet = (int)$xml->currentOperationSet;
		if(count($xml->currentOperationIndex))
			$this->currentOperationIndex = (int)$xml->currentOperationIndex;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $srcFileSyncLocalPath = null;

	/**
	 * The translated path as used by the scheduler
	 *
	 * @var string
	 */
	public $actualSrcFileSyncLocalPath = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $srcFileSyncRemoteUrl = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $engineVersion = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $flavorParamsOutputId = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Type_FlavorParamsOutput
	 */
	public $flavorParamsOutput;

	/**
	 * 
	 *
	 * @var int
	 */
	public $mediaInfoId = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $currentOperationSet = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $currentOperationIndex = null;


}

