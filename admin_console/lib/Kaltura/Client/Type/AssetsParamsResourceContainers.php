<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_AssetsParamsResourceContainers extends Kaltura_Client_Type_Resource
{
	public function getKalturaObjectType()
	{
		return 'KalturaAssetsParamsResourceContainers';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(empty($xml->resources))
			$this->resources = array();
		else
			$this->resources = Kaltura_Client_Client::unmarshalItem($xml->resources);
	}
	/**
	 * Array of resources associated with asset params ids
	 *
	 * @var array of KalturaAssetParamsResourceContainer
	 */
	public $resources;


}

