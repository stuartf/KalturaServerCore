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
class KalturaTrackEntryEventType
{
	const UPLOADED_FILE = 1;
	const WEBCAM_COMPLETED = 2;
	const IMPORT_STARTED = 3;
	const ADD_ENTRY = 4;
	const UPDATE_ENTRY = 5;
	const DELETED_ENTRY = 6;
}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaUiConfAdminOrderBy
{
	const CREATED_AT_ASC = "+createdAt";
	const CREATED_AT_DESC = "-createdAt";
	const UPDATED_AT_ASC = "+updatedAt";
	const UPDATED_AT_DESC = "-updatedAt";
}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaInvestigateFlavorAssetData extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var KalturaFlavorAsset
	 * @readonly
	 */
	public $flavorAsset;

	/**
	 * 
	 *
	 * @var KalturaFileSyncListResponse
	 * @readonly
	 */
	public $fileSyncs;

	/**
	 * 
	 *
	 * @var KalturaMediaInfoListResponse
	 * @readonly
	 */
	public $mediaInfos;

	/**
	 * 
	 *
	 * @var KalturaFlavorParams
	 * @readonly
	 */
	public $flavorParams;

	/**
	 * 
	 *
	 * @var KalturaFlavorParamsOutputListResponse
	 * @readonly
	 */
	public $flavorParamsOutputs;


}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaInvestigateThumbAssetData extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var KalturaThumbAsset
	 * @readonly
	 */
	public $thumbAsset;

	/**
	 * 
	 *
	 * @var KalturaFileSyncListResponse
	 * @readonly
	 */
	public $fileSyncs;

	/**
	 * 
	 *
	 * @var KalturaThumbParams
	 * @readonly
	 */
	public $thumbParams;

	/**
	 * 
	 *
	 * @var KalturaThumbParamsOutputListResponse
	 * @readonly
	 */
	public $thumbParamsOutputs;


}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaTrackEntry extends KalturaObjectBase
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
	 * @var KalturaTrackEntryEventType
	 */
	public $trackEventType = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $psVersion = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $context = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $partnerId = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $entryId = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $hostName = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $userId = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $changedProperties = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $paramStr1 = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $paramStr2 = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $paramStr3 = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $ks = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $description = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $createdAt = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $updatedAt = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $userIp = null;


}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaInvestigateEntryData extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var KalturaBaseEntry
	 * @readonly
	 */
	public $entry;

	/**
	 * 
	 *
	 * @var KalturaFileSyncListResponse
	 * @readonly
	 */
	public $fileSyncs;

	/**
	 * 
	 *
	 * @var KalturaBatchJobListResponse
	 * @readonly
	 */
	public $jobs;

	/**
	 * 
	 *
	 * @var array of KalturaInvestigateFlavorAssetData
	 * @readonly
	 */
	public $flavorAssets;

	/**
	 * 
	 *
	 * @var array of KalturaInvestigateThumbAssetData
	 * @readonly
	 */
	public $thumbAssets;

	/**
	 * 
	 *
	 * @var array of KalturaTrackEntry
	 * @readonly
	 */
	public $tracks;


}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaTrackEntryListResponse extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var array of KalturaTrackEntry
	 * @readonly
	 */
	public $objects;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $totalCount = null;


}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaUiConfAdmin extends KalturaUiConf
{
	/**
	 * 
	 *
	 * @var bool
	 */
	public $isPublic = null;


}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaUiConfAdminListResponse extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var array of KalturaUiConfAdmin
	 * @readonly
	 */
	public $objects;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $totalCount = null;


}

/**
 * @package Scheduler
 * @subpackage Client
 */
abstract class KalturaUiConfAdminBaseFilter extends KalturaUiConfFilter
{

}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaUiConfAdminFilter extends KalturaUiConfAdminBaseFilter
{

}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaAdminConsoleClientPlugin extends KalturaClientPlugin
{
	protected function __construct(KalturaClient $client)
	{
		parent::__construct($client);
	}

	/**
	 * @return KalturaAdminConsoleClientPlugin
	 */
	public static function get(KalturaClient $client)
	{
		return new KalturaAdminConsoleClientPlugin($client);
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
		return 'adminConsole';
	}
}

