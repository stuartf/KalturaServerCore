<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_MediaInfoFilter extends Kaltura_Client_Type_MediaInfoBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaMediaInfoFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

