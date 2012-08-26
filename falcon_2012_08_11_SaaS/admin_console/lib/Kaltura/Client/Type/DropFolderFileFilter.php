<?php
class Kaltura_Client_Type_DropFolderFileFilter extends Kaltura_Client_DropFolder_Type_DropFolderFileBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaDropFolderFileFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

