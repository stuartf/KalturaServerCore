<?php
class Kaltura_Client_Type_ScpDropFolder extends Kaltura_Client_DropFolder_Type_SshDropFolder
{
	public function getKalturaObjectType()
	{
		return 'KalturaScpDropFolder';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

