<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Metadata_Type_MetadataProfileFilter extends Kaltura_Client_Metadata_Type_MetadataProfileBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaMetadataProfileFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

