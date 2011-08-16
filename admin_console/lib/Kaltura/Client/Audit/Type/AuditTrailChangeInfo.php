<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Audit_Type_AuditTrailChangeInfo extends Kaltura_Client_Audit_Type_AuditTrailInfo
{
	public function getKalturaObjectType()
	{
		return 'KalturaAuditTrailChangeInfo';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(empty($xml->changedItems))
			$this->changedItems = array();
		else
			$this->changedItems = Kaltura_Client_Client::unmarshalItem($xml->changedItems);
	}
	/**
	 * 
	 *
	 * @var array of KalturaAuditTrailChangeItem
	 */
	public $changedItems;


}

