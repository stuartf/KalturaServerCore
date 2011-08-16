<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_AssetParamsOutput extends Kaltura_Client_Type_AssetParams
{
	public function getKalturaObjectType()
	{
		return 'KalturaAssetParamsOutput';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->assetParamsId))
			$this->assetParamsId = (int)$xml->assetParamsId;
		$this->assetParamsVersion = (string)$xml->assetParamsVersion;
		$this->assetId = (string)$xml->assetId;
		$this->assetVersion = (string)$xml->assetVersion;
		if(count($xml->readyBehavior))
			$this->readyBehavior = (int)$xml->readyBehavior;
	}
	/**
	 * 
	 *
	 * @var int
	 */
	public $assetParamsId = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $assetParamsVersion = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $assetId = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $assetVersion = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $readyBehavior = null;


}

