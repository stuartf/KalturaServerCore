<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_AdminConsole_Type_InvestigateFlavorAssetData extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaInvestigateFlavorAssetData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(!empty($xml->flavorAsset))
			$this->flavorAsset = Kaltura_Client_Client::unmarshalItem($xml->flavorAsset);
		if(!empty($xml->fileSyncs))
			$this->fileSyncs = Kaltura_Client_Client::unmarshalItem($xml->fileSyncs);
		if(!empty($xml->mediaInfos))
			$this->mediaInfos = Kaltura_Client_Client::unmarshalItem($xml->mediaInfos);
		if(!empty($xml->flavorParams))
			$this->flavorParams = Kaltura_Client_Client::unmarshalItem($xml->flavorParams);
		if(!empty($xml->flavorParamsOutputs))
			$this->flavorParamsOutputs = Kaltura_Client_Client::unmarshalItem($xml->flavorParamsOutputs);
	}
	/**
	 * 
	 *
	 * @var Kaltura_Client_Type_FlavorAsset
	 * @readonly
	 */
	public $flavorAsset;

	/**
	 * 
	 *
	 * @var Kaltura_Client_FileSync_Type_FileSyncListResponse
	 * @readonly
	 */
	public $fileSyncs;

	/**
	 * 
	 *
	 * @var Kaltura_Client_AdminConsole_Type_MediaInfoListResponse
	 * @readonly
	 */
	public $mediaInfos;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Type_FlavorParams
	 * @readonly
	 */
	public $flavorParams;

	/**
	 * 
	 *
	 * @var Kaltura_Client_AdminConsole_Type_FlavorParamsOutputListResponse
	 * @readonly
	 */
	public $flavorParamsOutputs;


}

