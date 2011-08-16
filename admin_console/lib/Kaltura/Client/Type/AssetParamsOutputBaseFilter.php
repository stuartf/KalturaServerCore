<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_Type_AssetParamsOutputBaseFilter extends Kaltura_Client_Type_AssetParamsFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaAssetParamsOutputBaseFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->assetParamsIdEqual))
			$this->assetParamsIdEqual = (int)$xml->assetParamsIdEqual;
		$this->assetParamsVersionEqual = (string)$xml->assetParamsVersionEqual;
		$this->assetIdEqual = (string)$xml->assetIdEqual;
		$this->assetVersionEqual = (string)$xml->assetVersionEqual;
	}
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
	public $assetParamsVersionEqual = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $assetIdEqual = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $assetVersionEqual = null;


}

