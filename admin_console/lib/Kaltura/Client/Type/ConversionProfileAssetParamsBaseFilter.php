<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_Type_ConversionProfileAssetParamsBaseFilter extends Kaltura_Client_Type_Filter
{
	public function getKalturaObjectType()
	{
		return 'KalturaConversionProfileAssetParamsBaseFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->conversionProfileIdEqual))
			$this->conversionProfileIdEqual = (int)$xml->conversionProfileIdEqual;
		$this->conversionProfileIdIn = (string)$xml->conversionProfileIdIn;
		if(count($xml->assetParamsIdEqual))
			$this->assetParamsIdEqual = (int)$xml->assetParamsIdEqual;
		$this->assetParamsIdIn = (string)$xml->assetParamsIdIn;
		if(count($xml->readyBehaviorEqual))
			$this->readyBehaviorEqual = (int)$xml->readyBehaviorEqual;
		$this->readyBehaviorIn = (string)$xml->readyBehaviorIn;
		if(count($xml->originEqual))
			$this->originEqual = (int)$xml->originEqual;
		$this->originIn = (string)$xml->originIn;
		$this->systemNameEqual = (string)$xml->systemNameEqual;
		$this->systemNameIn = (string)$xml->systemNameIn;
	}
	/**
	 * 
	 *
	 * @var int
	 */
	public $conversionProfileIdEqual = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $conversionProfileIdIn = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $assetParamsIdEqual = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $assetParamsIdIn = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_FlavorReadyBehaviorType
	 */
	public $readyBehaviorEqual = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $readyBehaviorIn = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_AssetParamsOrigin
	 */
	public $originEqual = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $originIn = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $systemNameEqual = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $systemNameIn = null;


}

