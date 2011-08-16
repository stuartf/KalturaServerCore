<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_Audit_Type_AuditTrailInfo extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaAuditTrailInfo';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

