<?php
// ===================================================================================================
//                           _  __     _ _
//                          | |/ /__ _| | |_ _  _ _ _ __ _
//                          | ' </ _` | |  _| || | '_/ _` |
//                          |_|\_\__,_|_|\__|\_,_|_| \__,_|
//
// This file is part of the Kaltura Collaborative Media Suite which allows users
// to do with audio, video, and animation what Wiki platfroms allow them to do with
// text.
//
// Copyright (C) 2006-2011  Kaltura Inc.
//
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU Affero General Public License as
// published by the Free Software Foundation, either version 3 of the
// License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU Affero General Public License for more details.
//
// You should have received a copy of the GNU Affero General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.
//
// @ignore
// ===================================================================================================

/**
 * @package Scheduler
 * @subpackage Client
 */
require_once(dirname(__FILE__) . "/../KalturaClientBase.php");
require_once(dirname(__FILE__) . "/../KalturaEnums.php");
require_once(dirname(__FILE__) . "/../KalturaTypes.php");

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaSystemPartnerLimitType
{
	const ENTRIES = "ENTRIES";
	const MONTHLY_STREAM_ENTRIES = "MONTHLY_STREAM_ENTRIES";
	const MONTHLY_BANDWIDTH = "MONTHLY_BANDWIDTH";
	const PUBLISHERS = "PUBLISHERS";
	const ADMIN_LOGIN_USERS = "ADMIN_LOGIN_USERS";
	const LOGIN_USERS = "LOGIN_USERS";
	const USER_LOGIN_ATTEMPTS = "USER_LOGIN_ATTEMPTS";
	const BULK_SIZE = "BULK_SIZE";
	const MONTHLY_STORAGE = "MONTHLY_STORAGE";
	const MONTHLY_STORAGE_AND_BANDWIDTH = "MONTHLY_STORAGE_AND_BANDWIDTH";
	const END_USERS = "END_USERS";
	const ACCESS_CONTROLS = "ACCESS_CONTROLS";
}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaSystemPartnerLimit extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var KalturaSystemPartnerLimitType
	 */
	public $type = null;

	/**
	 * 
	 *
	 * @var float
	 */
	public $max = null;


}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaSystemPartnerConfiguration extends KalturaObjectBase
{
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
	 * @var string
	 */
	public $thumbnailHost = null;

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
	 * @var KalturaStorageServePriority
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
	 * @var bool
	 */
	public $supportAnimatedThumbnails = null;

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
	public $defThumbDensity = null;

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

	/**
	 * 
	 *
	 * @var string
	 */
	public $notificationsConfig = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	public $allowMultiNotification = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $loginBlockPeriod = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $numPrevPassToKeep = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $passReplaceFreq = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	public $isFirstLogin = null;

	/**
	 * 
	 *
	 * @var KalturaPartnerGroupType
	 */
	public $partnerGroupType = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $partnerParentId = null;

	/**
	 * 
	 *
	 * @var array of KalturaSystemPartnerLimit
	 */
	public $limits;

	/**
	 * http/rtmp/hdnetwork
	 * 	 
	 *
	 * @var string
	 */
	public $streamerType = null;

	/**
	 * http/https, rtmp/rtmpe
	 * 	 
	 *
	 * @var string
	 */
	public $mediaProtocol = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $extendedFreeTrailExpiryReason = null;

	/**
	 * Unix timestamp (In seconds)
	 * 	 
	 *
	 * @var int
	 */
	public $extendedFreeTrailExpiryDate = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $extendedFreeTrail = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $crmId = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $crmLink = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $verticalClasiffication = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $partnerPackageClassOfService = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	public $enableBulkUploadNotificationsEmails = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $deliveryRestrictions = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $bulkUploadNotificationsEmail = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	public $internalUse = null;

	/**
	 * 
	 *
	 * @var KalturaSourceType
	 */
	public $defaultLiveStreamEntrySourceType = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $liveStreamProvisionParams = null;

	/**
	 * 
	 *
	 * @var KalturaBaseEntryFilter
	 */
	public $autoModerateEntryFilter;

	/**
	 * 
	 *
	 * @var string
	 */
	public $logoutUrl = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	public $defaultEntitlementEnforcement = null;


}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaSystemPartnerPackage extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var int
	 */
	public $id = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $name = null;


}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaSystemPartnerUsageItem extends KalturaObjectBase
{
	/**
	 * Partner ID
	 * 	 
	 *
	 * @var int
	 */
	public $partnerId = null;

	/**
	 * Partner name
	 * 	 
	 *
	 * @var string
	 */
	public $partnerName = null;

	/**
	 * Partner status
	 * 	 
	 *
	 * @var KalturaPartnerStatus
	 */
	public $partnerStatus = null;

	/**
	 * Partner package
	 * 	 
	 *
	 * @var int
	 */
	public $partnerPackage = null;

	/**
	 * Partner creation date (Unix timestamp)
	 * 	 
	 *
	 * @var int
	 */
	public $partnerCreatedAt = null;

	/**
	 * Number of player loads in the specific date range
	 * 	 
	 *
	 * @var int
	 */
	public $views = null;

	/**
	 * Number of plays in the specific date range
	 * 	 
	 *
	 * @var int
	 */
	public $plays = null;

	/**
	 * Number of new entries created during specific date range
	 * 	 
	 *
	 * @var int
	 */
	public $entriesCount = null;

	/**
	 * Total number of entries
	 * 	 
	 *
	 * @var int
	 */
	public $totalEntriesCount = null;

	/**
	 * Number of new video entries created during specific date range
	 * 	 
	 *
	 * @var int
	 */
	public $videoEntriesCount = null;

	/**
	 * Number of new image entries created during specific date range
	 * 	 
	 *
	 * @var int
	 */
	public $imageEntriesCount = null;

	/**
	 * Number of new audio entries created during specific date range
	 * 	 
	 *
	 * @var int
	 */
	public $audioEntriesCount = null;

	/**
	 * Number of new mix entries created during specific date range
	 * 	 
	 *
	 * @var int
	 */
	public $mixEntriesCount = null;

	/**
	 * The total bandwidth usage during the given date range (in MB)
	 * 	 
	 *
	 * @var float
	 */
	public $bandwidth = null;

	/**
	 * The total storage consumption (in MB)
	 * 	 
	 *
	 * @var float
	 */
	public $totalStorage = null;

	/**
	 * The change in storage consumption (new uploads) during the given date range (in MB)
	 * 	 
	 *
	 * @var float
	 */
	public $storage = null;

	/**
	 * The peak amount of storage consumption during the given date range for the specific publisher
	 * 	 
	 *
	 * @var float
	 */
	public $peakStorage = null;

	/**
	 * The average amount of storage consumption during the given date range for the specific publisher
	 * 	 
	 *
	 * @var float
	 */
	public $avgStorage = null;

	/**
	 * The combined amount of bandwidth and storage consumed during the given date range for the specific publisher
	 * 	 
	 *
	 * @var float
	 */
	public $combinedBandwidthStorage = null;


}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaSystemPartnerUsageListResponse extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var array of KalturaSystemPartnerUsageItem
	 */
	public $objects;

	/**
	 * 
	 *
	 * @var int
	 */
	public $totalCount = null;


}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaSystemPartnerOveragedLimit extends KalturaSystemPartnerLimit
{
	/**
	 * 
	 *
	 * @var float
	 */
	public $overagePrice = null;

	/**
	 * 
	 *
	 * @var float
	 */
	public $overageUnit = null;


}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaSystemPartnerUsageFilter extends KalturaFilter
{
	/**
	 * Date range from
	 * 	 
	 *
	 * @var int
	 */
	public $fromDate = null;

	/**
	 * Date range to
	 * 	 
	 *
	 * @var int
	 */
	public $toDate = null;

	/**
	 * Time zone offset
	 * 	 
	 *
	 * @var int
	 */
	public $timezoneOffset = null;


}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaSystemPartnerClientPlugin extends KalturaClientPlugin
{
	protected function __construct(KalturaClient $client)
	{
		parent::__construct($client);
	}

	/**
	 * @return KalturaSystemPartnerClientPlugin
	 */
	public static function get(KalturaClient $client)
	{
		return new KalturaSystemPartnerClientPlugin($client);
	}

	/**
	 * @return array<KalturaServiceBase>
	 */
	public function getServices()
	{
		$services = array(
		);
		return $services;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return 'systemPartner';
	}
}

