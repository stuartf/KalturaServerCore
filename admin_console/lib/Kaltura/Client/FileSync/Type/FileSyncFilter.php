<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_FileSync_Type_FileSyncFilter extends Kaltura_Client_FileSync_Type_FileSyncBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaFileSyncFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

