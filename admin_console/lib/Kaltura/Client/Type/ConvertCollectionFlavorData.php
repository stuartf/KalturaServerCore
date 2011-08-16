<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_ConvertCollectionFlavorData extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaConvertCollectionFlavorData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->flavorAssetId = (string)$xml->flavorAssetId;
		if(count($xml->flavorParamsOutputId))
			$this->flavorParamsOutputId = (int)$xml->flavorParamsOutputId;
		if(count($xml->readyBehavior))
			$this->readyBehavior = (int)$xml->readyBehavior;
		if(count($xml->videoBitrate))
			$this->videoBitrate = (int)$xml->videoBitrate;
		if(count($xml->audioBitrate))
			$this->audioBitrate = (int)$xml->audioBitrate;
		$this->destFileSyncLocalPath = (string)$xml->destFileSyncLocalPath;
		$this->destFileSyncRemoteUrl = (string)$xml->destFileSyncRemoteUrl;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $flavorAssetId = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $flavorParamsOutputId = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $readyBehavior = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $videoBitrate = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $audioBitrate = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $destFileSyncLocalPath = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $destFileSyncRemoteUrl = null;


}

