<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_MailJobFilter extends Kaltura_Client_Type_MailJobBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaMailJobFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

