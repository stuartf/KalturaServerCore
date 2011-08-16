<?php
/**
 * @package Scheduler
 * @subpackage Client
 */
require_once("KalturaClientBase.php");
require_once("KalturaEnums.php");
require_once("KalturaTypes.php");


/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaAccessControlService extends KalturaServiceBase
{
	function __construct(KalturaClient $client = null)
	{
		parent::__construct($client);
	}

	function listAction(KalturaAccessControlFilter $filter = null, KalturaFilterPager $pager = null)
	{
		$kparams = array();
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		if ($pager !== null)
			$this->client->addParam($kparams, "pager", $pager->toParams());
		$this->client->queueServiceActionCall("accesscontrol", "list", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaAccessControlListResponse");
		return $resultObject;
	}
}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaBaseEntryService extends KalturaServiceBase
{
	function __construct(KalturaClient $client = null)
	{
		parent::__construct($client);
	}

	function add(KalturaBaseEntry $entry, $type = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entry", $entry->toParams());
		$this->client->addParam($kparams, "type", $type);
		$this->client->queueServiceActionCall("baseentry", "add", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBaseEntry");
		return $resultObject;
	}

	function addContent($entryId, KalturaResource $resource)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$this->client->addParam($kparams, "resource", $resource->toParams());
		$this->client->queueServiceActionCall("baseentry", "addContent", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBaseEntry");
		return $resultObject;
	}

	function addFromUploadedFile(KalturaBaseEntry $entry, $uploadTokenId, $type = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entry", $entry->toParams());
		$this->client->addParam($kparams, "uploadTokenId", $uploadTokenId);
		$this->client->addParam($kparams, "type", $type);
		$this->client->queueServiceActionCall("baseentry", "addFromUploadedFile", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBaseEntry");
		return $resultObject;
	}

	function get($entryId, $version = -1)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$this->client->addParam($kparams, "version", $version);
		$this->client->queueServiceActionCall("baseentry", "get", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBaseEntry");
		return $resultObject;
	}

	function update($entryId, KalturaBaseEntry $baseEntry)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$this->client->addParam($kparams, "baseEntry", $baseEntry->toParams());
		$this->client->queueServiceActionCall("baseentry", "update", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBaseEntry");
		return $resultObject;
	}

	function updateContent($entryId, KalturaResource $resource, $conversionProfileId = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$this->client->addParam($kparams, "resource", $resource->toParams());
		$this->client->addParam($kparams, "conversionProfileId", $conversionProfileId);
		$this->client->queueServiceActionCall("baseentry", "updateContent", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBaseEntry");
		return $resultObject;
	}

	function getByIds($entryIds)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryIds", $entryIds);
		$this->client->queueServiceActionCall("baseentry", "getByIds", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}

	function delete($entryId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$this->client->queueServiceActionCall("baseentry", "delete", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "null");
		return $resultObject;
	}

	function listAction(KalturaBaseEntryFilter $filter = null, KalturaFilterPager $pager = null)
	{
		$kparams = array();
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		if ($pager !== null)
			$this->client->addParam($kparams, "pager", $pager->toParams());
		$this->client->queueServiceActionCall("baseentry", "list", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBaseEntryListResponse");
		return $resultObject;
	}

	function count(KalturaBaseEntryFilter $filter = null)
	{
		$kparams = array();
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		$this->client->queueServiceActionCall("baseentry", "count", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "integer");
		return $resultObject;
	}

	function upload($fileData)
	{
		$kparams = array();
		$kfiles = array();
		$this->client->addParam($kfiles, "fileData", $fileData);
		$this->client->queueServiceActionCall("baseentry", "upload", $kparams, $kfiles);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "string");
		return $resultObject;
	}

	function updateThumbnailJpeg($entryId, $fileData)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$kfiles = array();
		$this->client->addParam($kfiles, "fileData", $fileData);
		$this->client->queueServiceActionCall("baseentry", "updateThumbnailJpeg", $kparams, $kfiles);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBaseEntry");
		return $resultObject;
	}

	function updateThumbnailFromUrl($entryId, $url)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$this->client->addParam($kparams, "url", $url);
		$this->client->queueServiceActionCall("baseentry", "updateThumbnailFromUrl", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBaseEntry");
		return $resultObject;
	}

	function updateThumbnailFromSourceEntry($entryId, $sourceEntryId, $timeOffset)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$this->client->addParam($kparams, "sourceEntryId", $sourceEntryId);
		$this->client->addParam($kparams, "timeOffset", $timeOffset);
		$this->client->queueServiceActionCall("baseentry", "updateThumbnailFromSourceEntry", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBaseEntry");
		return $resultObject;
	}

	function flag(KalturaModerationFlag $moderationFlag)
	{
		$kparams = array();
		$this->client->addParam($kparams, "moderationFlag", $moderationFlag->toParams());
		$this->client->queueServiceActionCall("baseentry", "flag", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "null");
		return $resultObject;
	}

	function reject($entryId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$this->client->queueServiceActionCall("baseentry", "reject", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "null");
		return $resultObject;
	}

	function approve($entryId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$this->client->queueServiceActionCall("baseentry", "approve", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "null");
		return $resultObject;
	}

	function listFlags($entryId, KalturaFilterPager $pager = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		if ($pager !== null)
			$this->client->addParam($kparams, "pager", $pager->toParams());
		$this->client->queueServiceActionCall("baseentry", "listFlags", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaModerationFlagListResponse");
		return $resultObject;
	}

	function anonymousRank($entryId, $rank)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$this->client->addParam($kparams, "rank", $rank);
		$this->client->queueServiceActionCall("baseentry", "anonymousRank", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "null");
		return $resultObject;
	}

	function getContextData($entryId, KalturaEntryContextDataParams $contextDataParams)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$this->client->addParam($kparams, "contextDataParams", $contextDataParams->toParams());
		$this->client->queueServiceActionCall("baseentry", "getContextData", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaEntryContextDataResult");
		return $resultObject;
	}
}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaBatchcontrolService extends KalturaServiceBase
{
	function __construct(KalturaClient $client = null)
	{
		parent::__construct($client);
	}

	function reportStatus(KalturaScheduler $scheduler, array $schedulerStatuses, array $workerQueueFilters)
	{
		$kparams = array();
		$this->client->addParam($kparams, "scheduler", $scheduler->toParams());
		foreach($schedulerStatuses as $index => $obj)
		{
			$this->client->addParam($kparams, "schedulerStatuses:$index", $obj->toParams());
		}
		foreach($workerQueueFilters as $index => $obj)
		{
			$this->client->addParam($kparams, "workerQueueFilters:$index", $obj->toParams());
		}
		$this->client->queueServiceActionCall("batchcontrol", "reportStatus", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaSchedulerStatusResponse");
		return $resultObject;
	}

	function configLoaded(KalturaScheduler $scheduler, $configParam, $configValue, $configParamPart = null, $workerConfigId = null, $workerName = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "scheduler", $scheduler->toParams());
		$this->client->addParam($kparams, "configParam", $configParam);
		$this->client->addParam($kparams, "configValue", $configValue);
		$this->client->addParam($kparams, "configParamPart", $configParamPart);
		$this->client->addParam($kparams, "workerConfigId", $workerConfigId);
		$this->client->addParam($kparams, "workerName", $workerName);
		$this->client->queueServiceActionCall("batchcontrol", "configLoaded", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaSchedulerConfig");
		return $resultObject;
	}

	function stopScheduler($schedulerId, $adminId, $cause)
	{
		$kparams = array();
		$this->client->addParam($kparams, "schedulerId", $schedulerId);
		$this->client->addParam($kparams, "adminId", $adminId);
		$this->client->addParam($kparams, "cause", $cause);
		$this->client->queueServiceActionCall("batchcontrol", "stopScheduler", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaControlPanelCommand");
		return $resultObject;
	}

	function stopWorker($workerId, $adminId, $cause)
	{
		$kparams = array();
		$this->client->addParam($kparams, "workerId", $workerId);
		$this->client->addParam($kparams, "adminId", $adminId);
		$this->client->addParam($kparams, "cause", $cause);
		$this->client->queueServiceActionCall("batchcontrol", "stopWorker", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaControlPanelCommand");
		return $resultObject;
	}

	function kill($workerId, $batchIndex, $adminId, $cause)
	{
		$kparams = array();
		$this->client->addParam($kparams, "workerId", $workerId);
		$this->client->addParam($kparams, "batchIndex", $batchIndex);
		$this->client->addParam($kparams, "adminId", $adminId);
		$this->client->addParam($kparams, "cause", $cause);
		$this->client->queueServiceActionCall("batchcontrol", "kill", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaControlPanelCommand");
		return $resultObject;
	}

	function startWorker($workerId, $adminId, $cause = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "workerId", $workerId);
		$this->client->addParam($kparams, "adminId", $adminId);
		$this->client->addParam($kparams, "cause", $cause);
		$this->client->queueServiceActionCall("batchcontrol", "startWorker", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaControlPanelCommand");
		return $resultObject;
	}

	function setSchedulerConfig($schedulerId, $adminId, $configParam, $configValue, $configParamPart = null, $cause = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "schedulerId", $schedulerId);
		$this->client->addParam($kparams, "adminId", $adminId);
		$this->client->addParam($kparams, "configParam", $configParam);
		$this->client->addParam($kparams, "configValue", $configValue);
		$this->client->addParam($kparams, "configParamPart", $configParamPart);
		$this->client->addParam($kparams, "cause", $cause);
		$this->client->queueServiceActionCall("batchcontrol", "setSchedulerConfig", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaControlPanelCommand");
		return $resultObject;
	}

	function setWorkerConfig($workerId, $adminId, $configParam, $configValue, $configParamPart = null, $cause = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "workerId", $workerId);
		$this->client->addParam($kparams, "adminId", $adminId);
		$this->client->addParam($kparams, "configParam", $configParam);
		$this->client->addParam($kparams, "configValue", $configValue);
		$this->client->addParam($kparams, "configParamPart", $configParamPart);
		$this->client->addParam($kparams, "cause", $cause);
		$this->client->queueServiceActionCall("batchcontrol", "setWorkerConfig", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaControlPanelCommand");
		return $resultObject;
	}

	function setCommandResult($commandId, $status, $errorDescription = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "commandId", $commandId);
		$this->client->addParam($kparams, "status", $status);
		$this->client->addParam($kparams, "errorDescription", $errorDescription);
		$this->client->queueServiceActionCall("batchcontrol", "setCommandResult", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaControlPanelCommand");
		return $resultObject;
	}

	function listCommands(KalturaControlPanelCommandFilter $filter = null, KalturaFilterPager $pager = null)
	{
		$kparams = array();
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		if ($pager !== null)
			$this->client->addParam($kparams, "pager", $pager->toParams());
		$this->client->queueServiceActionCall("batchcontrol", "listCommands", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaControlPanelCommandListResponse");
		return $resultObject;
	}

	function getCommand($commandId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "commandId", $commandId);
		$this->client->queueServiceActionCall("batchcontrol", "getCommand", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaControlPanelCommand");
		return $resultObject;
	}

	function listSchedulers()
	{
		$kparams = array();
		$this->client->queueServiceActionCall("batchcontrol", "listSchedulers", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaSchedulerListResponse");
		return $resultObject;
	}

	function listWorkers()
	{
		$kparams = array();
		$this->client->queueServiceActionCall("batchcontrol", "listWorkers", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaSchedulerWorkerListResponse");
		return $resultObject;
	}

	function getFullStatus()
	{
		$kparams = array();
		$this->client->queueServiceActionCall("batchcontrol", "getFullStatus", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaControlPanelCommand");
		return $resultObject;
	}
}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaBatchService extends KalturaServiceBase
{
	function __construct(KalturaClient $client = null)
	{
		parent::__construct($client);
	}

	function getExclusiveImportJobs(KalturaExclusiveLockKey $lockKey, $maxExecutionTime, $numberOfJobs, KalturaBatchJobFilter $filter = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "maxExecutionTime", $maxExecutionTime);
		$this->client->addParam($kparams, "numberOfJobs", $numberOfJobs);
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		$this->client->queueServiceActionCall("batch", "getExclusiveImportJobs", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}

	function updateExclusiveImportJob($id, KalturaExclusiveLockKey $lockKey, KalturaBatchJob $job)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "job", $job->toParams());
		$this->client->queueServiceActionCall("batch", "updateExclusiveImportJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJob");
		return $resultObject;
	}

	function freeExclusiveImportJob($id, KalturaExclusiveLockKey $lockKey, $resetExecutionAttempts = false)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "resetExecutionAttempts", $resetExecutionAttempts);
		$this->client->queueServiceActionCall("batch", "freeExclusiveImportJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaFreeJobResponse");
		return $resultObject;
	}

	function getExclusiveBulkUploadJobs(KalturaExclusiveLockKey $lockKey, $maxExecutionTime, $numberOfJobs, KalturaBatchJobFilter $filter = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "maxExecutionTime", $maxExecutionTime);
		$this->client->addParam($kparams, "numberOfJobs", $numberOfJobs);
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		$this->client->queueServiceActionCall("batch", "getExclusiveBulkUploadJobs", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}

	function getExclusiveAlmostDoneBulkUploadJobs(KalturaExclusiveLockKey $lockKey, $maxExecutionTime, $numberOfJobs, KalturaBatchJobFilter $filter = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "maxExecutionTime", $maxExecutionTime);
		$this->client->addParam($kparams, "numberOfJobs", $numberOfJobs);
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		$this->client->queueServiceActionCall("batch", "getExclusiveAlmostDoneBulkUploadJobs", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}

	function updateExclusiveBulkUploadJob($id, KalturaExclusiveLockKey $lockKey, KalturaBatchJob $job)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "job", $job->toParams());
		$this->client->queueServiceActionCall("batch", "updateExclusiveBulkUploadJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJob");
		return $resultObject;
	}

	function freeExclusiveBulkUploadJob($id, KalturaExclusiveLockKey $lockKey, $resetExecutionAttempts = false)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "resetExecutionAttempts", $resetExecutionAttempts);
		$this->client->queueServiceActionCall("batch", "freeExclusiveBulkUploadJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaFreeJobResponse");
		return $resultObject;
	}

	function addBulkUploadResult(KalturaBulkUploadResult $bulkUploadResult, array $pluginDataArray = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "bulkUploadResult", $bulkUploadResult->toParams());
		if ($pluginDataArray !== null)
			foreach($pluginDataArray as $index => $obj)
			{
				$this->client->addParam($kparams, "pluginDataArray:$index", $obj->toParams());
			}
		$this->client->queueServiceActionCall("batch", "addBulkUploadResult", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBulkUploadResult");
		return $resultObject;
	}

	function getBulkUploadLastResult($bulkUploadJobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "bulkUploadJobId", $bulkUploadJobId);
		$this->client->queueServiceActionCall("batch", "getBulkUploadLastResult", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBulkUploadResult");
		return $resultObject;
	}

	function countBulkUploadEntries($bulkUploadJobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "bulkUploadJobId", $bulkUploadJobId);
		$this->client->queueServiceActionCall("batch", "countBulkUploadEntries", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "integer");
		return $resultObject;
	}

	function updateBulkUploadResults($bulkUploadJobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "bulkUploadJobId", $bulkUploadJobId);
		$this->client->queueServiceActionCall("batch", "updateBulkUploadResults", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "integer");
		return $resultObject;
	}

	function getExclusiveAlmostDoneConvertCollectionJobs(KalturaExclusiveLockKey $lockKey, $maxExecutionTime, $numberOfJobs, KalturaBatchJobFilter $filter = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "maxExecutionTime", $maxExecutionTime);
		$this->client->addParam($kparams, "numberOfJobs", $numberOfJobs);
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		$this->client->queueServiceActionCall("batch", "getExclusiveAlmostDoneConvertCollectionJobs", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}

	function getExclusiveAlmostDoneConvertProfileJobs(KalturaExclusiveLockKey $lockKey, $maxExecutionTime, $numberOfJobs, KalturaBatchJobFilter $filter = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "maxExecutionTime", $maxExecutionTime);
		$this->client->addParam($kparams, "numberOfJobs", $numberOfJobs);
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		$this->client->queueServiceActionCall("batch", "getExclusiveAlmostDoneConvertProfileJobs", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}

	function updateExclusiveConvertCollectionJob($id, KalturaExclusiveLockKey $lockKey, KalturaBatchJob $job, array $flavorsData = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "job", $job->toParams());
		if ($flavorsData !== null)
			foreach($flavorsData as $index => $obj)
			{
				$this->client->addParam($kparams, "flavorsData:$index", $obj->toParams());
			}
		$this->client->queueServiceActionCall("batch", "updateExclusiveConvertCollectionJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJob");
		return $resultObject;
	}

	function updateExclusiveConvertProfileJob($id, KalturaExclusiveLockKey $lockKey, KalturaBatchJob $job)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "job", $job->toParams());
		$this->client->queueServiceActionCall("batch", "updateExclusiveConvertProfileJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJob");
		return $resultObject;
	}

	function freeExclusiveConvertCollectionJob($id, KalturaExclusiveLockKey $lockKey, $resetExecutionAttempts = false)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "resetExecutionAttempts", $resetExecutionAttempts);
		$this->client->queueServiceActionCall("batch", "freeExclusiveConvertCollectionJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaFreeJobResponse");
		return $resultObject;
	}

	function freeExclusiveConvertProfileJob($id, KalturaExclusiveLockKey $lockKey, $resetExecutionAttempts = false)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "resetExecutionAttempts", $resetExecutionAttempts);
		$this->client->queueServiceActionCall("batch", "freeExclusiveConvertProfileJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaFreeJobResponse");
		return $resultObject;
	}

	function getExclusiveConvertCollectionJobs(KalturaExclusiveLockKey $lockKey, $maxExecutionTime, $numberOfJobs, KalturaBatchJobFilter $filter = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "maxExecutionTime", $maxExecutionTime);
		$this->client->addParam($kparams, "numberOfJobs", $numberOfJobs);
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		$this->client->queueServiceActionCall("batch", "getExclusiveConvertCollectionJobs", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}

	function getExclusiveConvertJobs(KalturaExclusiveLockKey $lockKey, $maxExecutionTime, $numberOfJobs, KalturaBatchJobFilter $filter = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "maxExecutionTime", $maxExecutionTime);
		$this->client->addParam($kparams, "numberOfJobs", $numberOfJobs);
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		$this->client->queueServiceActionCall("batch", "getExclusiveConvertJobs", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}

	function getExclusiveAlmostDoneConvertJobs(KalturaExclusiveLockKey $lockKey, $maxExecutionTime, $numberOfJobs, KalturaBatchJobFilter $filter = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "maxExecutionTime", $maxExecutionTime);
		$this->client->addParam($kparams, "numberOfJobs", $numberOfJobs);
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		$this->client->queueServiceActionCall("batch", "getExclusiveAlmostDoneConvertJobs", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}

	function updateExclusiveConvertJob($id, KalturaExclusiveLockKey $lockKey, KalturaBatchJob $job)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "job", $job->toParams());
		$this->client->queueServiceActionCall("batch", "updateExclusiveConvertJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJob");
		return $resultObject;
	}

	function updateExclusiveConvertJobSubType($id, KalturaExclusiveLockKey $lockKey, $subType)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "subType", $subType);
		$this->client->queueServiceActionCall("batch", "updateExclusiveConvertJobSubType", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJob");
		return $resultObject;
	}

	function freeExclusiveConvertJob($id, KalturaExclusiveLockKey $lockKey, $resetExecutionAttempts = false)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "resetExecutionAttempts", $resetExecutionAttempts);
		$this->client->queueServiceActionCall("batch", "freeExclusiveConvertJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaFreeJobResponse");
		return $resultObject;
	}

	function getExclusivePostConvertJobs(KalturaExclusiveLockKey $lockKey, $maxExecutionTime, $numberOfJobs, KalturaBatchJobFilter $filter = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "maxExecutionTime", $maxExecutionTime);
		$this->client->addParam($kparams, "numberOfJobs", $numberOfJobs);
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		$this->client->queueServiceActionCall("batch", "getExclusivePostConvertJobs", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}

	function updateExclusivePostConvertJob($id, KalturaExclusiveLockKey $lockKey, KalturaBatchJob $job)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "job", $job->toParams());
		$this->client->queueServiceActionCall("batch", "updateExclusivePostConvertJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJob");
		return $resultObject;
	}

	function freeExclusivePostConvertJob($id, KalturaExclusiveLockKey $lockKey, $resetExecutionAttempts = false)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "resetExecutionAttempts", $resetExecutionAttempts);
		$this->client->queueServiceActionCall("batch", "freeExclusivePostConvertJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaFreeJobResponse");
		return $resultObject;
	}

	function getExclusiveCaptureThumbJobs(KalturaExclusiveLockKey $lockKey, $maxExecutionTime, $numberOfJobs, KalturaBatchJobFilter $filter = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "maxExecutionTime", $maxExecutionTime);
		$this->client->addParam($kparams, "numberOfJobs", $numberOfJobs);
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		$this->client->queueServiceActionCall("batch", "getExclusiveCaptureThumbJobs", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}

	function updateExclusiveCaptureThumbJob($id, KalturaExclusiveLockKey $lockKey, KalturaBatchJob $job)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "job", $job->toParams());
		$this->client->queueServiceActionCall("batch", "updateExclusiveCaptureThumbJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJob");
		return $resultObject;
	}

	function freeExclusiveCaptureThumbJob($id, KalturaExclusiveLockKey $lockKey, $resetExecutionAttempts = false)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "resetExecutionAttempts", $resetExecutionAttempts);
		$this->client->queueServiceActionCall("batch", "freeExclusiveCaptureThumbJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaFreeJobResponse");
		return $resultObject;
	}

	function getExclusiveExtractMediaJobs(KalturaExclusiveLockKey $lockKey, $maxExecutionTime, $numberOfJobs, KalturaBatchJobFilter $filter = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "maxExecutionTime", $maxExecutionTime);
		$this->client->addParam($kparams, "numberOfJobs", $numberOfJobs);
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		$this->client->queueServiceActionCall("batch", "getExclusiveExtractMediaJobs", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}

	function updateExclusiveExtractMediaJob($id, KalturaExclusiveLockKey $lockKey, KalturaBatchJob $job)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "job", $job->toParams());
		$this->client->queueServiceActionCall("batch", "updateExclusiveExtractMediaJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJob");
		return $resultObject;
	}

	function addMediaInfo(KalturaMediaInfo $mediaInfo)
	{
		$kparams = array();
		$this->client->addParam($kparams, "mediaInfo", $mediaInfo->toParams());
		$this->client->queueServiceActionCall("batch", "addMediaInfo", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaMediaInfo");
		return $resultObject;
	}

	function freeExclusiveExtractMediaJob($id, KalturaExclusiveLockKey $lockKey, $resetExecutionAttempts = false)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "resetExecutionAttempts", $resetExecutionAttempts);
		$this->client->queueServiceActionCall("batch", "freeExclusiveExtractMediaJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaFreeJobResponse");
		return $resultObject;
	}

	function getExclusiveStorageExportJobs(KalturaExclusiveLockKey $lockKey, $maxExecutionTime, $numberOfJobs, KalturaBatchJobFilter $filter = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "maxExecutionTime", $maxExecutionTime);
		$this->client->addParam($kparams, "numberOfJobs", $numberOfJobs);
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		$this->client->queueServiceActionCall("batch", "getExclusiveStorageExportJobs", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}

	function updateExclusiveStorageExportJob($id, KalturaExclusiveLockKey $lockKey, KalturaBatchJob $job)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "job", $job->toParams());
		$this->client->queueServiceActionCall("batch", "updateExclusiveStorageExportJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJob");
		return $resultObject;
	}

	function freeExclusiveStorageExportJob($id, KalturaExclusiveLockKey $lockKey, $resetExecutionAttempts = false)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "resetExecutionAttempts", $resetExecutionAttempts);
		$this->client->queueServiceActionCall("batch", "freeExclusiveStorageExportJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaFreeJobResponse");
		return $resultObject;
	}

	function getExclusiveStorageDeleteJobs(KalturaExclusiveLockKey $lockKey, $maxExecutionTime, $numberOfJobs, KalturaBatchJobFilter $filter = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "maxExecutionTime", $maxExecutionTime);
		$this->client->addParam($kparams, "numberOfJobs", $numberOfJobs);
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		$this->client->queueServiceActionCall("batch", "getExclusiveStorageDeleteJobs", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}

	function updateExclusiveStorageDeleteJob($id, KalturaExclusiveLockKey $lockKey, KalturaBatchJob $job)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "job", $job->toParams());
		$this->client->queueServiceActionCall("batch", "updateExclusiveStorageDeleteJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJob");
		return $resultObject;
	}

	function freeExclusiveStorageDeleteJob($id, KalturaExclusiveLockKey $lockKey, $resetExecutionAttempts = false)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "resetExecutionAttempts", $resetExecutionAttempts);
		$this->client->queueServiceActionCall("batch", "freeExclusiveStorageDeleteJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaFreeJobResponse");
		return $resultObject;
	}

	function getExclusiveNotificationJobs(KalturaExclusiveLockKey $lockKey, $maxExecutionTime, $numberOfJobs, KalturaBatchJobFilter $filter = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "maxExecutionTime", $maxExecutionTime);
		$this->client->addParam($kparams, "numberOfJobs", $numberOfJobs);
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		$this->client->queueServiceActionCall("batch", "getExclusiveNotificationJobs", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchGetExclusiveNotificationJobsResponse");
		return $resultObject;
	}

	function updateExclusiveNotificationJob($id, KalturaExclusiveLockKey $lockKey, KalturaBatchJob $job)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "job", $job->toParams());
		$this->client->queueServiceActionCall("batch", "updateExclusiveNotificationJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJob");
		return $resultObject;
	}

	function freeExclusiveNotificationJob($id, KalturaExclusiveLockKey $lockKey, $resetExecutionAttempts = false)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "resetExecutionAttempts", $resetExecutionAttempts);
		$this->client->queueServiceActionCall("batch", "freeExclusiveNotificationJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaFreeJobResponse");
		return $resultObject;
	}

	function getExclusiveMailJobs(KalturaExclusiveLockKey $lockKey, $maxExecutionTime, $numberOfJobs, KalturaBatchJobFilter $filter = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "maxExecutionTime", $maxExecutionTime);
		$this->client->addParam($kparams, "numberOfJobs", $numberOfJobs);
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		$this->client->queueServiceActionCall("batch", "getExclusiveMailJobs", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}

	function updateExclusiveMailJob($id, KalturaExclusiveLockKey $lockKey, KalturaBatchJob $job)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "job", $job->toParams());
		$this->client->queueServiceActionCall("batch", "updateExclusiveMailJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJob");
		return $resultObject;
	}

	function freeExclusiveMailJob($id, KalturaExclusiveLockKey $lockKey, $resetExecutionAttempts = false)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "resetExecutionAttempts", $resetExecutionAttempts);
		$this->client->queueServiceActionCall("batch", "freeExclusiveMailJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaFreeJobResponse");
		return $resultObject;
	}

	function getExclusiveBulkDownloadJobs(KalturaExclusiveLockKey $lockKey, $maxExecutionTime, $numberOfJobs, KalturaBatchJobFilter $filter = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "maxExecutionTime", $maxExecutionTime);
		$this->client->addParam($kparams, "numberOfJobs", $numberOfJobs);
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		$this->client->queueServiceActionCall("batch", "getExclusiveBulkDownloadJobs", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}

	function getExclusiveAlmostDoneBulkDownloadJobs(KalturaExclusiveLockKey $lockKey, $maxExecutionTime, $numberOfJobs, KalturaBatchJobFilter $filter = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "maxExecutionTime", $maxExecutionTime);
		$this->client->addParam($kparams, "numberOfJobs", $numberOfJobs);
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		$this->client->queueServiceActionCall("batch", "getExclusiveAlmostDoneBulkDownloadJobs", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}

	function updateExclusiveBulkDownloadJob($id, KalturaExclusiveLockKey $lockKey, KalturaBatchJob $job)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "job", $job->toParams());
		$this->client->queueServiceActionCall("batch", "updateExclusiveBulkDownloadJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJob");
		return $resultObject;
	}

	function freeExclusiveBulkDownloadJob($id, KalturaExclusiveLockKey $lockKey, $resetExecutionAttempts = false)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "resetExecutionAttempts", $resetExecutionAttempts);
		$this->client->queueServiceActionCall("batch", "freeExclusiveBulkDownloadJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaFreeJobResponse");
		return $resultObject;
	}

	function getExclusiveProvisionProvideJobs(KalturaExclusiveLockKey $lockKey, $maxExecutionTime, $numberOfJobs, KalturaBatchJobFilter $filter = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "maxExecutionTime", $maxExecutionTime);
		$this->client->addParam($kparams, "numberOfJobs", $numberOfJobs);
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		$this->client->queueServiceActionCall("batch", "getExclusiveProvisionProvideJobs", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}

	function getExclusiveAlmostDoneProvisionProvideJobs(KalturaExclusiveLockKey $lockKey, $maxExecutionTime, $numberOfJobs, KalturaBatchJobFilter $filter = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "maxExecutionTime", $maxExecutionTime);
		$this->client->addParam($kparams, "numberOfJobs", $numberOfJobs);
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		$this->client->queueServiceActionCall("batch", "getExclusiveAlmostDoneProvisionProvideJobs", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}

	function updateExclusiveProvisionProvideJob($id, KalturaExclusiveLockKey $lockKey, KalturaBatchJob $job)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "job", $job->toParams());
		$this->client->queueServiceActionCall("batch", "updateExclusiveProvisionProvideJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJob");
		return $resultObject;
	}

	function freeExclusiveProvisionProvideJob($id, KalturaExclusiveLockKey $lockKey, $resetExecutionAttempts = false)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "resetExecutionAttempts", $resetExecutionAttempts);
		$this->client->queueServiceActionCall("batch", "freeExclusiveProvisionProvideJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaFreeJobResponse");
		return $resultObject;
	}

	function getExclusiveProvisionDeleteJobs(KalturaExclusiveLockKey $lockKey, $maxExecutionTime, $numberOfJobs, KalturaBatchJobFilter $filter = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "maxExecutionTime", $maxExecutionTime);
		$this->client->addParam($kparams, "numberOfJobs", $numberOfJobs);
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		$this->client->queueServiceActionCall("batch", "getExclusiveProvisionDeleteJobs", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}

	function getExclusiveAlmostDoneProvisionDeleteJobs(KalturaExclusiveLockKey $lockKey, $maxExecutionTime, $numberOfJobs, KalturaBatchJobFilter $filter = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "maxExecutionTime", $maxExecutionTime);
		$this->client->addParam($kparams, "numberOfJobs", $numberOfJobs);
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		$this->client->queueServiceActionCall("batch", "getExclusiveAlmostDoneProvisionDeleteJobs", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}

	function updateExclusiveProvisionDeleteJob($id, KalturaExclusiveLockKey $lockKey, KalturaBatchJob $job)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "job", $job->toParams());
		$this->client->queueServiceActionCall("batch", "updateExclusiveProvisionDeleteJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJob");
		return $resultObject;
	}

	function freeExclusiveProvisionDeleteJob($id, KalturaExclusiveLockKey $lockKey, $resetExecutionAttempts = false)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "resetExecutionAttempts", $resetExecutionAttempts);
		$this->client->queueServiceActionCall("batch", "freeExclusiveProvisionDeleteJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaFreeJobResponse");
		return $resultObject;
	}

	function resetJobExecutionAttempts($id, KalturaExclusiveLockKey $lockKey, $jobType)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "jobType", $jobType);
		$this->client->queueServiceActionCall("batch", "resetJobExecutionAttempts", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "null");
		return $resultObject;
	}

	function freeExclusiveJob($id, KalturaExclusiveLockKey $lockKey, $jobType, $resetExecutionAttempts = false)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "jobType", $jobType);
		$this->client->addParam($kparams, "resetExecutionAttempts", $resetExecutionAttempts);
		$this->client->queueServiceActionCall("batch", "freeExclusiveJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaFreeJobResponse");
		return $resultObject;
	}

	function getQueueSize(KalturaWorkerQueueFilter $workerQueueFilter)
	{
		$kparams = array();
		$this->client->addParam($kparams, "workerQueueFilter", $workerQueueFilter->toParams());
		$this->client->queueServiceActionCall("batch", "getQueueSize", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "integer");
		return $resultObject;
	}

	function getExclusiveJobs(KalturaExclusiveLockKey $lockKey, $maxExecutionTime, $numberOfJobs, KalturaBatchJobFilter $filter = null, $jobType = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "maxExecutionTime", $maxExecutionTime);
		$this->client->addParam($kparams, "numberOfJobs", $numberOfJobs);
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		$this->client->addParam($kparams, "jobType", $jobType);
		$this->client->queueServiceActionCall("batch", "getExclusiveJobs", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}

	function getExclusiveAlmostDone(KalturaExclusiveLockKey $lockKey, $maxExecutionTime, $numberOfJobs, KalturaBatchJobFilter $filter = null, $jobType = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "maxExecutionTime", $maxExecutionTime);
		$this->client->addParam($kparams, "numberOfJobs", $numberOfJobs);
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		$this->client->addParam($kparams, "jobType", $jobType);
		$this->client->queueServiceActionCall("batch", "getExclusiveAlmostDone", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}

	function updateExclusiveJob($id, KalturaExclusiveLockKey $lockKey, KalturaBatchJob $job)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "lockKey", $lockKey->toParams());
		$this->client->addParam($kparams, "job", $job->toParams());
		$this->client->queueServiceActionCall("batch", "updateExclusiveJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJob");
		return $resultObject;
	}

	function cleanExclusiveJobs()
	{
		$kparams = array();
		$this->client->queueServiceActionCall("batch", "cleanExclusiveJobs", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "integer");
		return $resultObject;
	}

	function logConversion($flavorAssetId, $data)
	{
		$kparams = array();
		$this->client->addParam($kparams, "flavorAssetId", $flavorAssetId);
		$this->client->addParam($kparams, "data", $data);
		$this->client->queueServiceActionCall("batch", "logConversion", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "null");
		return $resultObject;
	}

	function checkFileExists($localPath, $size)
	{
		$kparams = array();
		$this->client->addParam($kparams, "localPath", $localPath);
		$this->client->addParam($kparams, "size", $size);
		$this->client->queueServiceActionCall("batch", "checkFileExists", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaFileExistsResponse");
		return $resultObject;
	}
}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaBulkUploadService extends KalturaServiceBase
{
	function __construct(KalturaClient $client = null)
	{
		parent::__construct($client);
	}

	function add($conversionProfileId, $csvFileData, $bulkUploadType = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "conversionProfileId", $conversionProfileId);
		$kfiles = array();
		$this->client->addParam($kfiles, "csvFileData", $csvFileData);
		$this->client->addParam($kparams, "bulkUploadType", $bulkUploadType);
		$this->client->queueServiceActionCall("bulkupload", "add", $kparams, $kfiles);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBulkUpload");
		return $resultObject;
	}
}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaConversionProfileAssetParamsService extends KalturaServiceBase
{
	function __construct(KalturaClient $client = null)
	{
		parent::__construct($client);
	}

	function listAction(KalturaConversionProfileAssetParamsFilter $filter = null, KalturaFilterPager $pager = null)
	{
		$kparams = array();
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		if ($pager !== null)
			$this->client->addParam($kparams, "pager", $pager->toParams());
		$this->client->queueServiceActionCall("conversionprofileassetparams", "list", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaConversionProfileAssetParamsListResponse");
		return $resultObject;
	}
}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaConversionProfileService extends KalturaServiceBase
{
	function __construct(KalturaClient $client = null)
	{
		parent::__construct($client);
	}

	function getDefault()
	{
		$kparams = array();
		$this->client->queueServiceActionCall("conversionprofile", "getDefault", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaConversionProfile");
		return $resultObject;
	}

	function get($id)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->queueServiceActionCall("conversionprofile", "get", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaConversionProfile");
		return $resultObject;
	}

	function listAction(KalturaConversionProfileFilter $filter = null, KalturaFilterPager $pager = null)
	{
		$kparams = array();
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		if ($pager !== null)
			$this->client->addParam($kparams, "pager", $pager->toParams());
		$this->client->queueServiceActionCall("conversionprofile", "list", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaConversionProfileListResponse");
		return $resultObject;
	}
}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaEmailIngestionProfileService extends KalturaServiceBase
{
	function __construct(KalturaClient $client = null)
	{
		parent::__construct($client);
	}

	function add(KalturaEmailIngestionProfile $EmailIP)
	{
		$kparams = array();
		$this->client->addParam($kparams, "EmailIP", $EmailIP->toParams());
		$this->client->queueServiceActionCall("emailingestionprofile", "add", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaEmailIngestionProfile");
		return $resultObject;
	}

	function getByEmailAddress($emailAddress)
	{
		$kparams = array();
		$this->client->addParam($kparams, "emailAddress", $emailAddress);
		$this->client->queueServiceActionCall("emailingestionprofile", "getByEmailAddress", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaEmailIngestionProfile");
		return $resultObject;
	}

	function get($id)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->queueServiceActionCall("emailingestionprofile", "get", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaEmailIngestionProfile");
		return $resultObject;
	}

	function update($id, KalturaEmailIngestionProfile $EmailIP)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "EmailIP", $EmailIP->toParams());
		$this->client->queueServiceActionCall("emailingestionprofile", "update", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaEmailIngestionProfile");
		return $resultObject;
	}

	function delete($id)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->queueServiceActionCall("emailingestionprofile", "delete", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "null");
		return $resultObject;
	}

	function addMediaEntry(KalturaMediaEntry $mediaEntry, $uploadTokenId, $emailProfId, $fromAddress, $emailMsgId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "mediaEntry", $mediaEntry->toParams());
		$this->client->addParam($kparams, "uploadTokenId", $uploadTokenId);
		$this->client->addParam($kparams, "emailProfId", $emailProfId);
		$this->client->addParam($kparams, "fromAddress", $fromAddress);
		$this->client->addParam($kparams, "emailMsgId", $emailMsgId);
		$this->client->queueServiceActionCall("emailingestionprofile", "addMediaEntry", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaMediaEntry");
		return $resultObject;
	}
}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaFlavorAssetService extends KalturaServiceBase
{
	function __construct(KalturaClient $client = null)
	{
		parent::__construct($client);
	}

	function add($entryId, KalturaFlavorAsset $flavorAsset)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$this->client->addParam($kparams, "flavorAsset", $flavorAsset->toParams());
		$this->client->queueServiceActionCall("flavorasset", "add", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaFlavorAsset");
		return $resultObject;
	}

	function update($id, KalturaFlavorAsset $flavorAsset)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "flavorAsset", $flavorAsset->toParams());
		$this->client->queueServiceActionCall("flavorasset", "update", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaFlavorAsset");
		return $resultObject;
	}

	function setContent($id, KalturaContentResource $contentResource)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "contentResource", $contentResource->toParams());
		$this->client->queueServiceActionCall("flavorasset", "setContent", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaFlavorAsset");
		return $resultObject;
	}

	function get($id)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->queueServiceActionCall("flavorasset", "get", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaFlavorAsset");
		return $resultObject;
	}

	function getByEntryId($entryId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$this->client->queueServiceActionCall("flavorasset", "getByEntryId", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}

	function listAction(KalturaAssetFilter $filter = null, KalturaFilterPager $pager = null)
	{
		$kparams = array();
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		if ($pager !== null)
			$this->client->addParam($kparams, "pager", $pager->toParams());
		$this->client->queueServiceActionCall("flavorasset", "list", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaFlavorAssetListResponse");
		return $resultObject;
	}

	function getWebPlayableByEntryId($entryId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$this->client->queueServiceActionCall("flavorasset", "getWebPlayableByEntryId", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}

	function convert($entryId, $flavorParamsId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$this->client->addParam($kparams, "flavorParamsId", $flavorParamsId);
		$this->client->queueServiceActionCall("flavorasset", "convert", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "null");
		return $resultObject;
	}

	function reconvert($id)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->queueServiceActionCall("flavorasset", "reconvert", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "null");
		return $resultObject;
	}

	function delete($id)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->queueServiceActionCall("flavorasset", "delete", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "null");
		return $resultObject;
	}

	function getDownloadUrl($id, $useCdn = false)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "useCdn", $useCdn);
		$this->client->queueServiceActionCall("flavorasset", "getDownloadUrl", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "string");
		return $resultObject;
	}

	function getFlavorAssetsWithParams($entryId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$this->client->queueServiceActionCall("flavorasset", "getFlavorAssetsWithParams", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}
}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaFlavorParamsService extends KalturaServiceBase
{
	function __construct(KalturaClient $client = null)
	{
		parent::__construct($client);
	}

	function listAction(KalturaFlavorParamsFilter $filter = null, KalturaFilterPager $pager = null)
	{
		$kparams = array();
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		if ($pager !== null)
			$this->client->addParam($kparams, "pager", $pager->toParams());
		$this->client->queueServiceActionCall("flavorparams", "list", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaFlavorParamsListResponse");
		return $resultObject;
	}
}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaJobsService extends KalturaServiceBase
{
	function __construct(KalturaClient $client = null)
	{
		parent::__construct($client);
	}

	function getImportStatus($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "getImportStatus", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function deleteImport($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "deleteImport", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function abortImport($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "abortImport", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function retryImport($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "retryImport", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function getProvisionProvideStatus($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "getProvisionProvideStatus", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function deleteProvisionProvide($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "deleteProvisionProvide", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function abortProvisionProvide($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "abortProvisionProvide", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function retryProvisionProvide($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "retryProvisionProvide", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function getProvisionDeleteStatus($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "getProvisionDeleteStatus", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function deleteProvisionDelete($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "deleteProvisionDelete", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function abortProvisionDelete($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "abortProvisionDelete", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function retryProvisionDelete($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "retryProvisionDelete", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function getBulkUploadStatus($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "getBulkUploadStatus", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function deleteBulkUpload($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "deleteBulkUpload", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function abortBulkUpload($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "abortBulkUpload", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function retryBulkUpload($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "retryBulkUpload", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function getConvertStatus($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "getConvertStatus", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function getConvertCollectionStatus($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "getConvertCollectionStatus", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function getConvertProfileStatus($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "getConvertProfileStatus", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function addConvertProfileJob($entryId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$this->client->queueServiceActionCall("jobs", "addConvertProfileJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function getRemoteConvertStatus($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "getRemoteConvertStatus", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function deleteConvert($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "deleteConvert", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function abortConvert($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "abortConvert", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function retryConvert($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "retryConvert", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function deleteRemoteConvert($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "deleteRemoteConvert", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function abortRemoteConvert($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "abortRemoteConvert", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function retryRemoteConvert($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "retryRemoteConvert", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function deleteConvertCollection($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "deleteConvertCollection", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function deleteConvertProfile($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "deleteConvertProfile", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function abortConvertCollection($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "abortConvertCollection", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function abortConvertProfile($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "abortConvertProfile", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function retryConvertCollection($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "retryConvertCollection", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function retryConvertProfile($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "retryConvertProfile", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function getPostConvertStatus($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "getPostConvertStatus", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function deletePostConvert($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "deletePostConvert", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function abortPostConvert($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "abortPostConvert", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function retryPostConvert($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "retryPostConvert", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function getCaptureThumbStatus($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "getCaptureThumbStatus", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function deleteCaptureThumb($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "deleteCaptureThumb", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function abortCaptureThumb($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "abortCaptureThumb", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function retryCaptureThumb($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "retryCaptureThumb", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function getPullStatus($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "getPullStatus", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function deletePull($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "deletePull", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function abortPull($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "abortPull", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function retryPull($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "retryPull", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function getExtractMediaStatus($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "getExtractMediaStatus", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function deleteExtractMedia($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "deleteExtractMedia", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function abortExtractMedia($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "abortExtractMedia", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function retryExtractMedia($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "retryExtractMedia", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function getStorageExportStatus($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "getStorageExportStatus", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function deleteStorageExport($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "deleteStorageExport", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function abortStorageExport($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "abortStorageExport", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function retryStorageExport($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "retryStorageExport", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function getStorageDeleteStatus($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "getStorageDeleteStatus", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function deleteStorageDelete($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "deleteStorageDelete", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function abortStorageDelete($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "abortStorageDelete", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function retryStorageDelete($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "retryStorageDelete", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function getNotificationStatus($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "getNotificationStatus", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function deleteNotification($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "deleteNotification", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function abortNotification($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "abortNotification", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function retryNotification($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "retryNotification", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function getMailStatus($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "getMailStatus", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function deleteMail($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "deleteMail", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function abortMail($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "abortMail", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function retryMail($jobId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->queueServiceActionCall("jobs", "retryMail", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function addMailJob(KalturaMailJobData $mailJobData)
	{
		$kparams = array();
		$this->client->addParam($kparams, "mailJobData", $mailJobData->toParams());
		$this->client->queueServiceActionCall("jobs", "addMailJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "null");
		return $resultObject;
	}

	function addBatchJob(KalturaBatchJob $batchJob)
	{
		$kparams = array();
		$this->client->addParam($kparams, "batchJob", $batchJob->toParams());
		$this->client->queueServiceActionCall("jobs", "addBatchJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJob");
		return $resultObject;
	}

	function getStatus($jobId, $jobType, KalturaFilterPager $pager = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->addParam($kparams, "jobType", $jobType);
		if ($pager !== null)
			$this->client->addParam($kparams, "pager", $pager->toParams());
		$this->client->queueServiceActionCall("jobs", "getStatus", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function deleteJob($jobId, $jobType)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->addParam($kparams, "jobType", $jobType);
		$this->client->queueServiceActionCall("jobs", "deleteJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function abortJob($jobId, $jobType)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->addParam($kparams, "jobType", $jobType);
		$this->client->queueServiceActionCall("jobs", "abortJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function retryJob($jobId, $jobType)
	{
		$kparams = array();
		$this->client->addParam($kparams, "jobId", $jobId);
		$this->client->addParam($kparams, "jobType", $jobType);
		$this->client->queueServiceActionCall("jobs", "retryJob", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobResponse");
		return $resultObject;
	}

	function listBatchJobs(KalturaBatchJobFilterExt $filter = null, KalturaFilterPager $pager = null)
	{
		$kparams = array();
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		if ($pager !== null)
			$this->client->addParam($kparams, "pager", $pager->toParams());
		$this->client->queueServiceActionCall("jobs", "listBatchJobs", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaBatchJobListResponse");
		return $resultObject;
	}
}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaMediaService extends KalturaServiceBase
{
	function __construct(KalturaClient $client = null)
	{
		parent::__construct($client);
	}

	function add(KalturaMediaEntry $entry)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entry", $entry->toParams());
		$this->client->queueServiceActionCall("media", "add", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaMediaEntry");
		return $resultObject;
	}

	function addContent($entryId, KalturaResource $resource = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		if ($resource !== null)
			$this->client->addParam($kparams, "resource", $resource->toParams());
		$this->client->queueServiceActionCall("media", "addContent", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaMediaEntry");
		return $resultObject;
	}

	function get($entryId, $version = -1)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$this->client->addParam($kparams, "version", $version);
		$this->client->queueServiceActionCall("media", "get", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaMediaEntry");
		return $resultObject;
	}
}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaSessionService extends KalturaServiceBase
{
	function __construct(KalturaClient $client = null)
	{
		parent::__construct($client);
	}

	function start($secret, $userId = "", $type = 0, $partnerId = null, $expiry = 86400, $privileges = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "secret", $secret);
		$this->client->addParam($kparams, "userId", $userId);
		$this->client->addParam($kparams, "type", $type);
		$this->client->addParam($kparams, "partnerId", $partnerId);
		$this->client->addParam($kparams, "expiry", $expiry);
		$this->client->addParam($kparams, "privileges", $privileges);
		$this->client->queueServiceActionCall("session", "start", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "string");
		return $resultObject;
	}
}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaStorageProfileService extends KalturaServiceBase
{
	function __construct(KalturaClient $client = null)
	{
		parent::__construct($client);
	}

	function listAction(KalturaStorageProfileFilter $filter = null, KalturaFilterPager $pager = null)
	{
		$kparams = array();
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		if ($pager !== null)
			$this->client->addParam($kparams, "pager", $pager->toParams());
		$this->client->queueServiceActionCall("storageprofile", "list", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaStorageProfileListResponse");
		return $resultObject;
	}
}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaSystemService extends KalturaServiceBase
{
	function __construct(KalturaClient $client = null)
	{
		parent::__construct($client);
	}

	function ping()
	{
		$kparams = array();
		$this->client->queueServiceActionCall("system", "ping", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$resultObject = (bool) $resultObject;
		return $resultObject;
	}
}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaThumbAssetService extends KalturaServiceBase
{
	function __construct(KalturaClient $client = null)
	{
		parent::__construct($client);
	}

	function add($entryId, KalturaThumbAsset $thumbAsset)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$this->client->addParam($kparams, "thumbAsset", $thumbAsset->toParams());
		$this->client->queueServiceActionCall("thumbasset", "add", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaThumbAsset");
		return $resultObject;
	}

	function setContent($id, KalturaContentResource $contentResource)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "contentResource", $contentResource->toParams());
		$this->client->queueServiceActionCall("thumbasset", "setContent", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaThumbAsset");
		return $resultObject;
	}

	function update($id, KalturaThumbAsset $thumbAsset, KalturaContentResource $contentResource = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "thumbAsset", $thumbAsset->toParams());
		if ($contentResource !== null)
			$this->client->addParam($kparams, "contentResource", $contentResource->toParams());
		$this->client->queueServiceActionCall("thumbasset", "update", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaThumbAsset");
		return $resultObject;
	}

	function serveByEntryId($entryId, $thumbParamId = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$this->client->addParam($kparams, "thumbParamId", $thumbParamId);
		$this->client->queueServiceActionCall('thumbasset', 'serveByEntryId', $kparams);
		$resultObject = $this->client->getServeUrl();
		return $resultObject;
	}

	function serve($thumbAssetId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "thumbAssetId", $thumbAssetId);
		$this->client->queueServiceActionCall('thumbasset', 'serve', $kparams);
		$resultObject = $this->client->getServeUrl();
		return $resultObject;
	}

	function setAsDefault($thumbAssetId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "thumbAssetId", $thumbAssetId);
		$this->client->queueServiceActionCall("thumbasset", "setAsDefault", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "null");
		return $resultObject;
	}

	function generateByEntryId($entryId, $destThumbParamsId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$this->client->addParam($kparams, "destThumbParamsId", $destThumbParamsId);
		$this->client->queueServiceActionCall("thumbasset", "generateByEntryId", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaThumbAsset");
		return $resultObject;
	}

	function generate($entryId, KalturaThumbParams $thumbParams, $sourceAssetId = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$this->client->addParam($kparams, "thumbParams", $thumbParams->toParams());
		$this->client->addParam($kparams, "sourceAssetId", $sourceAssetId);
		$this->client->queueServiceActionCall("thumbasset", "generate", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaThumbAsset");
		return $resultObject;
	}

	function regenerate($thumbAssetId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "thumbAssetId", $thumbAssetId);
		$this->client->queueServiceActionCall("thumbasset", "regenerate", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaThumbAsset");
		return $resultObject;
	}

	function get($thumbAssetId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "thumbAssetId", $thumbAssetId);
		$this->client->queueServiceActionCall("thumbasset", "get", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaThumbAsset");
		return $resultObject;
	}

	function getByEntryId($entryId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$this->client->queueServiceActionCall("thumbasset", "getByEntryId", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}

	function listAction(KalturaAssetFilter $filter = null, KalturaFilterPager $pager = null)
	{
		$kparams = array();
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		if ($pager !== null)
			$this->client->addParam($kparams, "pager", $pager->toParams());
		$this->client->queueServiceActionCall("thumbasset", "list", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaThumbAssetListResponse");
		return $resultObject;
	}

	function addFromUrl($entryId, $url)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$this->client->addParam($kparams, "url", $url);
		$this->client->queueServiceActionCall("thumbasset", "addFromUrl", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaThumbAsset");
		return $resultObject;
	}

	function addFromImage($entryId, $fileData)
	{
		$kparams = array();
		$this->client->addParam($kparams, "entryId", $entryId);
		$kfiles = array();
		$this->client->addParam($kfiles, "fileData", $fileData);
		$this->client->queueServiceActionCall("thumbasset", "addFromImage", $kparams, $kfiles);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "KalturaThumbAsset");
		return $resultObject;
	}

	function delete($thumbAssetId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "thumbAssetId", $thumbAssetId);
		$this->client->queueServiceActionCall("thumbasset", "delete", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "null");
		return $resultObject;
	}
}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaUploadService extends KalturaServiceBase
{
	function __construct(KalturaClient $client = null)
	{
		parent::__construct($client);
	}

	function upload($fileData)
	{
		$kparams = array();
		$kfiles = array();
		$this->client->addParam($kfiles, "fileData", $fileData);
		$this->client->queueServiceActionCall("upload", "upload", $kparams, $kfiles);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "string");
		return $resultObject;
	}
}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaClient extends KalturaClientBase
{
	/**
	 * @var string
	 */
	protected $apiVersion = '3.1.3';

	/**
	 * Add & Manage Access Controls
	 * @var KalturaAccessControlService
	 */
	public $accessControl = null;

	/**
	 * Base Entry Service
	 * @var KalturaBaseEntryService
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
	 * @var KalturaBatchcontrolService
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
	 * @var KalturaBatchService
	 */
	public $batch = null;

	/**
	 * Bulk upload service is used to upload & manage bulk uploads using CSV files
	 * @var KalturaBulkUploadService
	 */
	public $bulkUpload = null;

	/**
	 * Manage the connection between Conversion Profiles and Asset Params
	 * @var KalturaConversionProfileAssetParamsService
	 */
	public $conversionProfileAssetParams = null;

	/**
	 * Add & Manage Conversion Profiles
	 * @var KalturaConversionProfileService
	 */
	public $conversionProfile = null;

	/**
	 * EmailIngestionProfile service lets you manage email ingestion profile records
	 * @var KalturaEmailIngestionProfileService
	 */
	public $EmailIngestionProfile = null;

	/**
	 * Retrieve information and invoke actions on Flavor Asset
	 * @var KalturaFlavorAssetService
	 */
	public $flavorAsset = null;

	/**
	 * Add & Manage Flavor Params
	 * @var KalturaFlavorParamsService
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
	 * @var KalturaJobsService
	 */
	public $jobs = null;

	/**
	 * Media service lets you upload and manage media files (images / videos & audio)
	 * @var KalturaMediaService
	 */
	public $media = null;

	/**
	 * Session service
	 * @var KalturaSessionService
	 */
	public $session = null;

	/**
	 * Storage Profiles service
	 * @var KalturaStorageProfileService
	 */
	public $storageProfile = null;

	/**
	 * System service is used for internal system helpers & to retrieve system level information
	 * @var KalturaSystemService
	 */
	public $system = null;

	/**
	 * Retrieve information and invoke actions on Thumb Asset
	 * @var KalturaThumbAssetService
	 */
	public $thumbAsset = null;

	/**
	 * 
	 * @var KalturaUploadService
	 */
	public $upload = null;

	/**
	 * Kaltura client constructor
	 *
	 * @param KalturaConfiguration $config
	 */
	public function __construct(KalturaConfiguration $config)
	{
		parent::__construct($config);
		
		$this->accessControl = new KalturaAccessControlService($this);
		$this->baseEntry = new KalturaBaseEntryService($this);
		$this->batchcontrol = new KalturaBatchcontrolService($this);
		$this->batch = new KalturaBatchService($this);
		$this->bulkUpload = new KalturaBulkUploadService($this);
		$this->conversionProfileAssetParams = new KalturaConversionProfileAssetParamsService($this);
		$this->conversionProfile = new KalturaConversionProfileService($this);
		$this->EmailIngestionProfile = new KalturaEmailIngestionProfileService($this);
		$this->flavorAsset = new KalturaFlavorAssetService($this);
		$this->flavorParams = new KalturaFlavorParamsService($this);
		$this->jobs = new KalturaJobsService($this);
		$this->media = new KalturaMediaService($this);
		$this->session = new KalturaSessionService($this);
		$this->storageProfile = new KalturaStorageProfileService($this);
		$this->system = new KalturaSystemService($this);
		$this->thumbAsset = new KalturaThumbAssetService($this);
		$this->upload = new KalturaUploadService($this);
	}
	
}

