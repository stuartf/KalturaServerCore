<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_Type_FlavorParamsOutputBaseFilter extends Kaltura_Client_Type_FlavorParamsFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaFlavorParamsOutputBaseFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->flavorParamsIdEqual))
			$this->flavorParamsIdEqual = (int)$xml->flavorParamsIdEqual;
		$this->flavorParamsVersionEqual = (string)$xml->flavorParamsVersionEqual;
		$this->flavorAssetIdEqual = (string)$xml->flavorAssetIdEqual;
		$this->flavorAssetVersionEqual = (string)$xml->flavorAssetVersionEqual;
	}
	/**
	 * 
	 *
	 * @var int
	 */
	public $flavorParamsIdEqual = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $flavorParamsVersionEqual = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $flavorAssetIdEqual = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $flavorAssetVersionEqual = null;


}

