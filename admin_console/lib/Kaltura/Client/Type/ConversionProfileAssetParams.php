<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_ConversionProfileAssetParams extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaConversionProfileAssetParams';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->conversionProfileId))
			$this->conversionProfileId = (int)$xml->conversionProfileId;
		if(count($xml->assetParamsId))
			$this->assetParamsId = (int)$xml->assetParamsId;
		if(count($xml->readyBehavior))
			$this->readyBehavior = (int)$xml->readyBehavior;
		if(count($xml->origin))
			$this->origin = (int)$xml->origin;
		$this->systemName = (string)$xml->systemName;
	}
	/**
	 * The id of the conversion profile
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $conversionProfileId = null;

	/**
	 * The id of the asset params
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $assetParamsId = null;

	/**
	 * The ingestion origin of the asset params
	 * 
	 *
	 * @var Kaltura_Client_Enum_FlavorReadyBehaviorType
	 */
	public $readyBehavior = null;

	/**
	 * The ingestion origin of the asset params
	 * 
	 *
	 * @var Kaltura_Client_Enum_AssetParamsOrigin
	 */
	public $origin = null;

	/**
	 * Asset params system name
	 * 
	 *
	 * @var string
	 */
	public $systemName = null;


}

