<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_SessionRestriction extends Kaltura_Client_Type_BaseRestriction
{
	public function getKalturaObjectType()
	{
		return 'KalturaSessionRestriction';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

