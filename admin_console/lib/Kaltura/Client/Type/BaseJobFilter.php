<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_BaseJobFilter extends Kaltura_Client_Type_BaseJobBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaBaseJobFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

