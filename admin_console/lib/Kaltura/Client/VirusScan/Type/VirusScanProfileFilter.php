<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_VirusScan_Type_VirusScanProfileFilter extends Kaltura_Client_VirusScan_Type_VirusScanProfileBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaVirusScanProfileFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

