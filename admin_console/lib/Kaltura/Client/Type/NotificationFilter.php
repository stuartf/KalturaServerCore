<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_NotificationFilter extends Kaltura_Client_Type_NotificationBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaNotificationFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

