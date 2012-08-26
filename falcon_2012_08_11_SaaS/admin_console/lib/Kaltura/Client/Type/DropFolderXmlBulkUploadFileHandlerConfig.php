<?php
class Kaltura_Client_Type_DropFolderXmlBulkUploadFileHandlerConfig extends Kaltura_Client_DropFolder_Type_DropFolderFileHandlerConfig
{
	public function getKalturaObjectType()
	{
		return 'KalturaDropFolderXmlBulkUploadFileHandlerConfig';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

