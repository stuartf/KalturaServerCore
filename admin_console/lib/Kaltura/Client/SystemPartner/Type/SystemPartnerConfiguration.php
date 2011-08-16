<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_SystemPartner_Type_SystemPartnerConfiguration extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaSystemPartnerConfiguration';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->partnerName = (string)$xml->partnerName;
		$this->description = (string)$xml->description;
		$this->adminName = (string)$xml->adminName;
		$this->adminEmail = (string)$xml->adminEmail;
		$this->host = (string)$xml->host;
		$this->cdnHost = (string)$xml->cdnHost;
		if(count($xml->maxBulkSize))
			$this->maxBulkSize = (int)$xml->maxBulkSize;
		if(count($xml->partnerPackage))
			$this->partnerPackage = (int)$xml->partnerPackage;
		if(count($xml->monitorUsage))
			$this->monitorUsage = (int)$xml->monitorUsage;
		if(!empty($xml->moderateContent))
			$this->moderateContent = true;
		$this->rtmpUrl = (string)$xml->rtmpUrl;
		if(!empty($xml->storageDeleteFromKaltura))
			$this->storageDeleteFromKaltura = true;
		if(count($xml->storageServePriority))
			$this->storageServePriority = (int)$xml->storageServePriority;
		if(count($xml->kmcVersion))
			$this->kmcVersion = (int)$xml->kmcVersion;
		if(count($xml->restrictThumbnailByKs))
			$this->restrictThumbnailByKs = (int)$xml->restrictThumbnailByKs;
		if(count($xml->defThumbOffset))
			$this->defThumbOffset = (int)$xml->defThumbOffset;
		if(count($xml->adminLoginUsersQuota))
			$this->adminLoginUsersQuota = (int)$xml->adminLoginUsersQuota;
		if(count($xml->userSessionRoleId))
			$this->userSessionRoleId = (int)$xml->userSessionRoleId;
		if(count($xml->adminSessionRoleId))
			$this->adminSessionRoleId = (int)$xml->adminSessionRoleId;
		$this->alwaysAllowedPermissionNames = (string)$xml->alwaysAllowedPermissionNames;
		if(!empty($xml->importRemoteSourceForConvert))
			$this->importRemoteSourceForConvert = true;
		if(empty($xml->permissions))
			$this->permissions = array();
		else
			$this->permissions = Kaltura_Client_Client::unmarshalItem($xml->permissions);
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $partnerName = null;

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
	 */
	public $adminName = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $adminEmail = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $host = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $cdnHost = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $maxBulkSize = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $partnerPackage = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $monitorUsage = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	public $moderateContent = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $rtmpUrl = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	public $storageDeleteFromKaltura = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_StorageServePriority
	 */
	public $storageServePriority = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $kmcVersion = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $restrictThumbnailByKs = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $defThumbOffset = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $adminLoginUsersQuota = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $userSessionRoleId = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $adminSessionRoleId = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $alwaysAllowedPermissionNames = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	public $importRemoteSourceForConvert = null;

	/**
	 * 
	 *
	 * @var array of KalturaPermission
	 */
	public $permissions;


}

