<?php
class Kaltura_Client_Type_MetadataFilter extends Kaltura_Client_Metadata_Type_MetadataBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaMetadataFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

