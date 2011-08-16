<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_Type_MailJobBaseFilter extends Kaltura_Client_Type_BaseJobFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaMailJobBaseFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

