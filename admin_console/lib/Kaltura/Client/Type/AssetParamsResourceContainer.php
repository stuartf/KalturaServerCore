<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_AssetParamsResourceContainer extends Kaltura_Client_Type_Resource
{
	public function getKalturaObjectType()
	{
		return 'KalturaAssetParamsResourceContainer';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(!empty($xml->resource))
			$this->resource = Kaltura_Client_Client::unmarshalItem($xml->resource);
		if(count($xml->assetParamsId))
			$this->assetParamsId = (int)$xml->assetParamsId;
	}
	/**
	 * The content resource to associate with asset params
	 *
	 * @var Kaltura_Client_Type_ContentResource
	 */
	public $resource;

	/**
	 * The asset params to associate with the reaource
	 *
	 * @var int
	 */
	public $assetParamsId = null;


}

