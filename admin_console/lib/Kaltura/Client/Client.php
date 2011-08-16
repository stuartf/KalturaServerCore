<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Client extends Kaltura_Client_ClientBase
{
	/**
	 * @var string
	 */
	protected $apiVersion = '3.1.3';

	/**
	 * Add & Manage Access Controls
	 * @var Kaltura_Client_AccessControlService
	 */
	public $accessControl = null;

	/**
	 * Manage details for the administrative user
	 * @var Kaltura_Client_AdminUserService
	 */
	public $adminUser = null;

	/**
	 * Base Entry Service
	 * @var Kaltura_Client_BaseEntryService
	 */
	public $baseEntry = null;

	/**
	 * batch service lets you handle different batch process from remote machines.
	 * As oppesed to other ojects in the system, locking mechanism is critical in this case.
	 * For this reason the GetExclusiveXX, UpdateExclusiveXX and FreeExclusiveXX actions are important for the system's intergity.
	 * In general - updating batch object should be done only using the UpdateExclusiveXX which in turn can be called only after 
	 * acuiring a batch objet properly (using  GetExclusiveXX).
	 * If an object was aquired and should be returned to the pool in it's initial state - use the FreeExclusiveXX action 
	 * 
	 * @var Kaltura_Client_BatchcontrolService
	 */
	public $batchcontrol = null;

	/**
	 * batch service lets you handle different batch process from remote machines.
	 * As oppesed to other ojects in the system, locking mechanism is critical in this case.
	 * For this reason the GetExclusiveXX, UpdateExclusiveXX and FreeExclusiveXX actions are important for the system's intergity.
	 * In general - updating batch object should be done only using the UpdateExclusiveXX which in turn can be called only after 
	 * acuiring a batch objet properly (using  GetExclusiveXX).
	 * If an object was aquired and should be returned to the pool in it's initial state - use the FreeExclusiveXX action 
	 * 
	 * @var Kaltura_Client_BatchService
	 */
	public $batch = null;

	/**
	 * Bulk upload service is used to upload & manage bulk uploads using CSV files
	 * @var Kaltura_Client_BulkUploadService
	 */
	public $bulkUpload = null;

	/**
	 * Add & Manage Categories
	 * @var Kaltura_Client_CategoryService
	 */
	public $category = null;

	/**
	 * Manage the connection between Conversion Profiles and Asset Params
	 * @var Kaltura_Client_ConversionProfileAssetParamsService
	 */
	public $conversionProfileAssetParams = null;

	/**
	 * Add & Manage Conversion Profiles
	 * @var Kaltura_Client_ConversionProfileService
	 */
	public $conversionProfile = null;

	/**
	 * Data service lets you manage data content (textual content)
	 * @var Kaltura_Client_DataService
	 */
	public $data = null;

	/**
	 * Document service
	 * DEPRECATED
	 * @var Kaltura_Client_DocumentService
	 */
	public $document = null;

	/**
	 * EmailIngestionProfile service lets you manage email ingestion profile records
	 * @var Kaltura_Client_EmailIngestionProfileService
	 */
	public $EmailIngestionProfile = null;

	/**
	 * Retrieve information and invoke actions on Flavor Asset
	 * @var Kaltura_Client_FlavorAssetService
	 */
	public $flavorAsset = null;

	/**
	 * Add & Manage Flavor Params
	 * @var Kaltura_Client_FlavorParamsService
	 */
	public $flavorParams = null;

	/**
	 * batch service lets you handle different batch process from remote machines.
	 * As oppesed to other ojects in the system, locking mechanism is critical in this case.
	 * For this reason the GetExclusiveXX, UpdateExclusiveXX and FreeExclusiveXX actions are important for the system's intergity.
	 * In general - updating batch object should be done only using the UpdateExclusiveXX which in turn can be called only after 
	 * acuiring a batch objet properly (using  GetExclusiveXX).
	 * If an object was aquired and should be returned to the pool in it's initial state - use the FreeExclusiveXX action 
	 * 
	 * @var Kaltura_Client_JobsService
	 */
	public $jobs = null;

	/**
	 * Live Stream service lets you manage live stream channels
	 * @var Kaltura_Client_LiveStreamService
	 */
	public $liveStream = null;

	/**
	 * Media service lets you upload and manage media files (images / videos & audio)
	 * @var Kaltura_Client_MediaService
	 */
	public $media = null;

	/**
	 * A Mix is an XML unique format invented by Kaltura, it allows the user to create a mix of videos and images, in and out points, transitions, text overlays, soundtrack, effects and much more...
	 * Mixing service lets you create a new mix, manage its metadata and make basic manipulations.   
	 * @var Kaltura_Client_MixingService
	 */
	public $mixing = null;

	/**
	 * Notification Service
	 * @var Kaltura_Client_NotificationService
	 */
	public $notification = null;

	/**
	 * partner service allows you to change/manage your partner personal details and settings as well
	 * @var Kaltura_Client_PartnerService
	 */
	public $partner = null;

	/**
	 * PermissionItem service lets you create and manage permission items
	 * @var Kaltura_Client_PermissionItemService
	 */
	public $permissionItem = null;

	/**
	 * Permission service lets you create and manage user permissions
	 * @var Kaltura_Client_PermissionService
	 */
	public $permission = null;

	/**
	 * Playlist service lets you create,manage and play your playlists
	 * Playlists could be static (containing a fixed list of entries) or dynamic (baseed on a filter)
	 * @var Kaltura_Client_PlaylistService
	 */
	public $playlist = null;

	/**
	 * api for getting reports data by the report type and some inputFilter
	 * @var Kaltura_Client_ReportService
	 */
	public $report = null;

	/**
	 * Search service allows you to search for media in various media providers
	 * This service is being used mostly by the CW component
	 * @var Kaltura_Client_SearchService
	 */
	public $search = null;

	/**
	 * Session service
	 * @var Kaltura_Client_SessionService
	 */
	public $session = null;

	/**
	 * Stats Service
	 * @var Kaltura_Client_StatsService
	 */
	public $stats = null;

	/**
	 * Storage Profiles service
	 * @var Kaltura_Client_StorageProfileService
	 */
	public $storageProfile = null;

	/**
	 * Add & Manage Syndication Feeds
	 * @var Kaltura_Client_SyndicationFeedService
	 */
	public $syndicationFeed = null;

	/**
	 * System service is used for internal system helpers & to retrieve system level information
	 * @var Kaltura_Client_SystemService
	 */
	public $system = null;

	/**
	 * Retrieve information and invoke actions on Thumb Asset
	 * @var Kaltura_Client_ThumbAssetService
	 */
	public $thumbAsset = null;

	/**
	 * Add & Manage Thumb Params
	 * @var Kaltura_Client_ThumbParamsService
	 */
	public $thumbParams = null;

	/**
	 * UiConf service lets you create and manage your UIConfs for the various flash components
	 * This service is used by the KMC-ApplicationStudio
	 * @var Kaltura_Client_UiConfService
	 */
	public $uiConf = null;

	/**
	 * 
	 * @var Kaltura_Client_UploadService
	 */
	public $upload = null;

	/**
	 * 
	 * @var Kaltura_Client_UploadTokenService
	 */
	public $uploadToken = null;

	/**
	 * UserRole service lets you create and manage user roles
	 * @var Kaltura_Client_UserRoleService
	 */
	public $userRole = null;

	/**
	 * Manage partner users on Kaltura's side
	 * The userId in kaltura is the unique Id in the partner's system, and the [partnerId,Id] couple are unique key in kaltura's DB
	 * @var Kaltura_Client_UserService
	 */
	public $user = null;

	/**
	 * widget service for full widget management
	 * @var Kaltura_Client_WidgetService
	 */
	public $widget = null;

	/**
	 * Internal Service is used for actions that are used internally in Kaltura applications and might be changed in the future without any notice.
	 * @var Kaltura_Client_XInternalService
	 */
	public $xInternal = null;

	/**
	 * Kaltura client constructor
	 *
	 * @param Kaltura_Client_Configuration $config
	 */
	public function __construct(Kaltura_Client_Configuration $config)
	{
		parent::__construct($config);
		
		$this->accessControl = new Kaltura_Client_AccessControlService($this);
		$this->adminUser = new Kaltura_Client_AdminUserService($this);
		$this->baseEntry = new Kaltura_Client_BaseEntryService($this);
		$this->batchcontrol = new Kaltura_Client_BatchcontrolService($this);
		$this->batch = new Kaltura_Client_BatchService($this);
		$this->bulkUpload = new Kaltura_Client_BulkUploadService($this);
		$this->category = new Kaltura_Client_CategoryService($this);
		$this->conversionProfileAssetParams = new Kaltura_Client_ConversionProfileAssetParamsService($this);
		$this->conversionProfile = new Kaltura_Client_ConversionProfileService($this);
		$this->data = new Kaltura_Client_DataService($this);
		$this->document = new Kaltura_Client_DocumentService($this);
		$this->EmailIngestionProfile = new Kaltura_Client_EmailIngestionProfileService($this);
		$this->flavorAsset = new Kaltura_Client_FlavorAssetService($this);
		$this->flavorParams = new Kaltura_Client_FlavorParamsService($this);
		$this->jobs = new Kaltura_Client_JobsService($this);
		$this->liveStream = new Kaltura_Client_LiveStreamService($this);
		$this->media = new Kaltura_Client_MediaService($this);
		$this->mixing = new Kaltura_Client_MixingService($this);
		$this->notification = new Kaltura_Client_NotificationService($this);
		$this->partner = new Kaltura_Client_PartnerService($this);
		$this->permissionItem = new Kaltura_Client_PermissionItemService($this);
		$this->permission = new Kaltura_Client_PermissionService($this);
		$this->playlist = new Kaltura_Client_PlaylistService($this);
		$this->report = new Kaltura_Client_ReportService($this);
		$this->search = new Kaltura_Client_SearchService($this);
		$this->session = new Kaltura_Client_SessionService($this);
		$this->stats = new Kaltura_Client_StatsService($this);
		$this->storageProfile = new Kaltura_Client_StorageProfileService($this);
		$this->syndicationFeed = new Kaltura_Client_SyndicationFeedService($this);
		$this->system = new Kaltura_Client_SystemService($this);
		$this->thumbAsset = new Kaltura_Client_ThumbAssetService($this);
		$this->thumbParams = new Kaltura_Client_ThumbParamsService($this);
		$this->uiConf = new Kaltura_Client_UiConfService($this);
		$this->upload = new Kaltura_Client_UploadService($this);
		$this->uploadToken = new Kaltura_Client_UploadTokenService($this);
		$this->userRole = new Kaltura_Client_UserRoleService($this);
		$this->user = new Kaltura_Client_UserService($this);
		$this->widget = new Kaltura_Client_WidgetService($this);
		$this->xInternal = new Kaltura_Client_XInternalService($this);
	}
	
}
