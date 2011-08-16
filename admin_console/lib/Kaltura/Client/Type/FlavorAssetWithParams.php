<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_FlavorAssetWithParams extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaFlavorAssetWithParams';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(!empty($xml->flavorAsset))
			$this->flavorAsset = Kaltura_Client_Client::unmarshalItem($xml->flavorAsset);
		if(!empty($xml->flavorParams))
			$this->flavorParams = Kaltura_Client_Client::unmarshalItem($xml->flavorParams);
		$this->entryId = (string)$xml->entryId;
	}
	/**
	 * The Flavor Asset (Can be null when there are params without asset)
	 * 
	 *
	 * @var Kaltura_Client_Type_FlavorAsset
	 */
	public $flavorAsset;

	/**
	 * The Flavor Params
	 * 
	 *
	 * @var Kaltura_Client_Type_FlavorParams
	 */
	public $flavorParams;

	/**
	 * The entry id
	 * 
	 *
	 * @var string
	 */
	public $entryId = null;


}

