<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_AdminConsole_Type_InvestigateThumbAssetData extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaInvestigateThumbAssetData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(!empty($xml->thumbAsset))
			$this->thumbAsset = Kaltura_Client_Client::unmarshalItem($xml->thumbAsset);
		if(!empty($xml->fileSyncs))
			$this->fileSyncs = Kaltura_Client_Client::unmarshalItem($xml->fileSyncs);
		if(!empty($xml->thumbParams))
			$this->thumbParams = Kaltura_Client_Client::unmarshalItem($xml->thumbParams);
		if(!empty($xml->thumbParamsOutputs))
			$this->thumbParamsOutputs = Kaltura_Client_Client::unmarshalItem($xml->thumbParamsOutputs);
	}
	/**
	 * 
	 *
	 * @var Kaltura_Client_Type_ThumbAsset
	 * @readonly
	 */
	public $thumbAsset;

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
	 * @var Kaltura_Client_Type_ThumbParams
	 * @readonly
	 */
	public $thumbParams;

	/**
	 * 
	 *
	 * @var Kaltura_Client_AdminConsole_Type_ThumbParamsOutputListResponse
	 * @readonly
	 */
	public $thumbParamsOutputs;


}

