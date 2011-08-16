<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_ShortLink_Type_ShortLinkFilter extends Kaltura_Client_ShortLink_Type_ShortLinkBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaShortLinkFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

