<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Audit_Type_AuditTrailTextInfo extends Kaltura_Client_Audit_Type_AuditTrailInfo
{
	public function getKalturaObjectType()
	{
		return 'KalturaAuditTrailTextInfo';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->info = (string)$xml->info;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $info = null;


}

