<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Audit_Type_AuditTrailFileSyncCreateInfo extends Kaltura_Client_Audit_Type_AuditTrailInfo
{
	public function getKalturaObjectType()
	{
		return 'KalturaAuditTrailFileSyncCreateInfo';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->version = (string)$xml->version;
		if(count($xml->objectSubType))
			$this->objectSubType = (int)$xml->objectSubType;
		if(count($xml->dc))
			$this->dc = (int)$xml->dc;
		if(!empty($xml->original))
			$this->original = true;
		if(count($xml->fileType))
			$this->fileType = (int)$xml->fileType;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $version = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $objectSubType = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $dc = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	public $original = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Audit_Enum_AuditTrailFileSyncType
	 */
	public $fileType = null;


}

