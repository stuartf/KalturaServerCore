<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Audit_Type_AuditTrailFilter extends Kaltura_Client_Audit_Type_AuditTrailBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaAuditTrailFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

