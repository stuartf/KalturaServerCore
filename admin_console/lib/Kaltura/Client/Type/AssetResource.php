<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_AssetResource extends Kaltura_Client_Type_ContentResource
{
	public function getKalturaObjectType()
	{
		return 'KalturaAssetResource';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->assetId = (string)$xml->assetId;
	}
	/**
	 * ID of the source asset 
	 *
	 * @var string
	 */
	public $assetId = null;


}

