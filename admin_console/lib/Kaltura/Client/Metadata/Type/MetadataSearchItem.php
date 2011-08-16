<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Metadata_Type_MetadataSearchItem extends Kaltura_Client_Type_SearchOperator
{
	public function getKalturaObjectType()
	{
		return 'KalturaMetadataSearchItem';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->metadataProfileId))
			$this->metadataProfileId = (int)$xml->metadataProfileId;
	}
	/**
	 * 
	 *
	 * @var int
	 */
	public $metadataProfileId = null;


}

