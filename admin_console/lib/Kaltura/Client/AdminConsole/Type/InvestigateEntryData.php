<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_AdminConsole_Type_InvestigateEntryData extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaInvestigateEntryData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(!empty($xml->entry))
			$this->entry = Kaltura_Client_Client::unmarshalItem($xml->entry);
		if(!empty($xml->fileSyncs))
			$this->fileSyncs = Kaltura_Client_Client::unmarshalItem($xml->fileSyncs);
		if(!empty($xml->jobs))
			$this->jobs = Kaltura_Client_Client::unmarshalItem($xml->jobs);
		if(empty($xml->flavorAssets))
			$this->flavorAssets = array();
		else
			$this->flavorAssets = Kaltura_Client_Client::unmarshalItem($xml->flavorAssets);
		if(empty($xml->thumbAssets))
			$this->thumbAssets = array();
		else
			$this->thumbAssets = Kaltura_Client_Client::unmarshalItem($xml->thumbAssets);
		if(empty($xml->tracks))
			$this->tracks = array();
		else
			$this->tracks = Kaltura_Client_Client::unmarshalItem($xml->tracks);
	}
	/**
	 * 
	 *
	 * @var Kaltura_Client_Type_BaseEntry
	 * @readonly
	 */
	public $entry;

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
	 * @var Kaltura_Client_Type_BatchJobListResponse
	 * @readonly
	 */
	public $jobs;

	/**
	 * 
	 *
	 * @var array of KalturaInvestigateFlavorAssetData
	 * @readonly
	 */
	public $flavorAssets;

	/**
	 * 
	 *
	 * @var array of KalturaInvestigateThumbAssetData
	 * @readonly
	 */
	public $thumbAssets;

	/**
	 * 
	 *
	 * @var array of KalturaTrackEntry
	 * @readonly
	 */
	public $tracks;


}

