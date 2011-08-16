<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_CaptureThumbJobData extends Kaltura_Client_Type_JobData
{
	public function getKalturaObjectType()
	{
		return 'KalturaCaptureThumbJobData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->srcFileSyncLocalPath = (string)$xml->srcFileSyncLocalPath;
		$this->actualSrcFileSyncLocalPath = (string)$xml->actualSrcFileSyncLocalPath;
		$this->srcFileSyncRemoteUrl = (string)$xml->srcFileSyncRemoteUrl;
		if(count($xml->thumbParamsOutputId))
			$this->thumbParamsOutputId = (int)$xml->thumbParamsOutputId;
		if(!empty($xml->thumbParamsOutput))
			$this->thumbParamsOutput = Kaltura_Client_Client::unmarshalItem($xml->thumbParamsOutput);
		$this->thumbAssetId = (string)$xml->thumbAssetId;
		$this->srcAssetType = (string)$xml->srcAssetType;
		$this->thumbPath = (string)$xml->thumbPath;
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
	public $thumbParamsOutputId = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Type_ThumbParamsOutput
	 */
	public $thumbParamsOutput;

	/**
	 * 
	 *
	 * @var string
	 */
	public $thumbAssetId = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_AssetType
	 */
	public $srcAssetType = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $thumbPath = null;


}

