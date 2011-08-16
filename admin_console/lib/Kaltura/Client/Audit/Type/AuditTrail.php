<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Audit_Type_AuditTrail extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaAuditTrail';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->id))
			$this->id = (int)$xml->id;
		if(count($xml->createdAt))
			$this->createdAt = (int)$xml->createdAt;
		if(count($xml->parsedAt))
			$this->parsedAt = (int)$xml->parsedAt;
		if(count($xml->status))
			$this->status = (int)$xml->status;
		$this->auditObjectType = (string)$xml->auditObjectType;
		$this->objectId = (string)$xml->objectId;
		$this->relatedObjectId = (string)$xml->relatedObjectId;
		$this->relatedObjectType = (string)$xml->relatedObjectType;
		$this->entryId = (string)$xml->entryId;
		if(count($xml->masterPartnerId))
			$this->masterPartnerId = (int)$xml->masterPartnerId;
		if(count($xml->partnerId))
			$this->partnerId = (int)$xml->partnerId;
		$this->requestId = (string)$xml->requestId;
		$this->userId = (string)$xml->userId;
		$this->action = (string)$xml->action;
		if(!empty($xml->data))
			$this->data = Kaltura_Client_Client::unmarshalItem($xml->data);
		$this->ks = (string)$xml->ks;
		if(count($xml->context))
			$this->context = (int)$xml->context;
		$this->entryPoint = (string)$xml->entryPoint;
		$this->serverName = (string)$xml->serverName;
		$this->ipAddress = (string)$xml->ipAddress;
		$this->userAgent = (string)$xml->userAgent;
		$this->clientTag = (string)$xml->clientTag;
		$this->description = (string)$xml->description;
		$this->errorDescription = (string)$xml->errorDescription;
	}
	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $id = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $createdAt = null;

	/**
	 * Indicates when the data was parsed
	 *
	 * @var int
	 * @readonly
	 */
	public $parsedAt = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Audit_Enum_AuditTrailStatus
	 * @readonly
	 */
	public $status = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Audit_Enum_AuditTrailObjectType
	 */
	public $auditObjectType = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $objectId = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $relatedObjectId = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Audit_Enum_AuditTrailObjectType
	 */
	public $relatedObjectType = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $entryId = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $masterPartnerId = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $partnerId = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $requestId = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $userId = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Audit_Enum_AuditTrailAction
	 */
	public $action = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Audit_Type_AuditTrailInfo
	 */
	public $data;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $ks = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Audit_Enum_AuditTrailContext
	 * @readonly
	 */
	public $context = null;

	/**
	 * The API service and action that called and caused this audit
	 *
	 * @var string
	 * @readonly
	 */
	public $entryPoint = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $serverName = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $ipAddress = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $userAgent = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $clientTag = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $description = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $errorDescription = null;


}

