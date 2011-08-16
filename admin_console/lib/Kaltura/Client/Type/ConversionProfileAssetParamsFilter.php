<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_ConversionProfileAssetParamsFilter extends Kaltura_Client_Type_ConversionProfileAssetParamsBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaConversionProfileAssetParamsFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(!empty($xml->conversionProfileIdFilter))
			$this->conversionProfileIdFilter = Kaltura_Client_Client::unmarshalItem($xml->conversionProfileIdFilter);
		if(!empty($xml->assetParamsIdFilter))
			$this->assetParamsIdFilter = Kaltura_Client_Client::unmarshalItem($xml->assetParamsIdFilter);
	}
	/**
	 * 
	 *
	 * @var Kaltura_Client_Type_ConversionProfileFilter
	 */
	public $conversionProfileIdFilter;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Type_AssetParamsFilter
	 */
	public $assetParamsIdFilter;


}

