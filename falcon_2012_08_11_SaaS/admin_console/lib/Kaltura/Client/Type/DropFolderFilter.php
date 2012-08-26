<?php
class Kaltura_Client_Type_DropFolderFilter extends Kaltura_Client_DropFolder_Type_DropFolderBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaDropFolderFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

