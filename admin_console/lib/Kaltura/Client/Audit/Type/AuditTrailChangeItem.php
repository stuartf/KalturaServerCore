<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Audit_Type_AuditTrailChangeItem extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaAuditTrailChangeItem';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->descriptor = (string)$xml->descriptor;
		$this->oldValue = (string)$xml->oldValue;
		$this->newValue = (string)$xml->newValue;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $descriptor = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $oldValue = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $newValue = null;


}

