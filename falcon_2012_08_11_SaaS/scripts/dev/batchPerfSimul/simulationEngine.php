<?php

require_once('phpLibrary.php');

define('SF_ROOT_DIR',	realpath('/opt/kaltura/app/alpha'));
define('SF_APP',		 'kaltura');
define('SF_ENVIRONMENT', 'batch');
define('SF_DEBUG',	   true);

ini_set("memory_limit", "2048M");

require_once('/opt/kaltura/app/api_v3/bootstrap.php');

require_once('sortedArray.php');

error_reporting(E_ALL);

/********************************************************
 *		Utility functions
 ********************************************************/
function debugLog($debugMsg)
{
	global $currentTime, $PARAMETERS;

	if ($PARAMETERS['debugLogEnabled'])
	{
		print("$currentTime: $debugMsg\n");
	}
}

function endswith($string, $test) 
{
    $testlen = strlen($test);
    if ($testlen > strlen($string))
    {
		return false;    	
    }
    return substr_compare($string, $test, -$testlen) === 0;
}

function valueOrNull(array &$array, $key)
{
	if (array_key_exists($key, $array))
	{
		return $array[$key];
	}
	return null;
}

function intOrNull(array &$array, $key)
{
	if (array_key_exists($key, $array))
	{
		return intval($array[$key]);
	}
	return null;
}

/********************************************************
 *		Database functions
 ********************************************************/
function initializePropel()
{
	$ilreplConfig = array (
		'classname' => 'KalturaPDO',
		'phptype' => 'mysql',
		'database' => 'kaltura',
		'hostspec' => 'ilrepl.kaltura.dev',
		'user' => 'kaltura',
		'password' => 'kaltura',
		'dsn' => 'mysql:host=ilrepl.kaltura.dev;port=3306;dbname=kaltura;user=kaltura;password=kaltura;',
	);

	$localConfig = array (
		'classname' => 'KalturaPDO',
		'phptype' => 'mysql',
		'database' => 'kaltura',
		'hostspec' => 'localhost',
		'user' => 'root',
		'password' => '',
		'dsn' => 'mysql:host=localhost;port=3306;dbname=kaltura;user=root;password=;',
	);
	
	$dbConfig = array (
	  'datasources' => 
		array (
			'default' => 'propel',	 
			'propel' => 
			array (
				'adapter' => 'mysql',
				'connection' => 
				$localConfig,
			),
		),
	);

	Propel::setConfiguration($dbConfig);
	Propel::setLogger(KalturaLog::getInstance());
	Propel::initialize();
}

function enumBatchJobs($startTime, $endTime, $callback)
{
	global $PARAMETERS;

	for ($curTime = $startTime; $curTime < $endTime; $curTime = $nextTime)
	{
		$nextTime = ($curTime + 24 * 60 * 60);

		$queryStart = date('Y-m-d', $curTime);
		$queryEnd = date('Y-m-d', $nextTime);

		$curTime = date('Y-m-d H:i:s');
		$memUsage = memory_get_usage();
		print("$curTime Running query $queryStart - $queryEnd... (Mem=$memUsage)\n");

		$criteria = new Criteria();
		$criteria->addAnd(BatchJobPeer::CREATED_AT, $queryStart, Criteria::GREATER_EQUAL);
		$criteria->addAnd(BatchJobPeer::CREATED_AT, $queryEnd, Criteria::LESS_THAN);
		$criteria->addAnd(BatchJobPeer::JOB_TYPE, BatchJobType::CONVERT, Criteria::EQUAL);
		if ($PARAMETERS['simulatedSchedulerIds'] != 'all')
		{		
			$criteria->addAnd(BatchJobPeer::LAST_SCHEDULER_ID, $PARAMETERS['simulatedSchedulerIds'], Criteria::IN);
		}
		
		$criteria->addAscendingOrderByColumn(BatchJobPeer::CREATED_AT);

		$batchJobs = BatchJobPeer::doSelect($criteria);

		$curTime = date('Y-m-d H:i:s');
		$memUsage = memory_get_usage();
		$batchJobCount = count($batchJobs);
		print("$curTime Processing $batchJobCount query results... (Mem=$memUsage)\n");
		
		foreach ($batchJobs as $batchJob)
		{
			$callback($batchJob);
		}
		
		BatchJobPeer::clearInstancePool();
		mediaInfoPeer::clearInstancePool();
	}
}

function getRunningJobs($currentTime)
{
	global $PARAMETERS;

	$criteria = new Criteria();
	
	# queue time/finish time are not indexed, use createdAt to limit the search (more than 90% of the jobs complete within 7hrs)
	$minCreatedAtStr = date('Y-m-d', $currentTime - 24 * 3600);
	$currentTimeStr = date('Y-m-d', $currentTime);
	
	$criteria->addAnd(BatchJobPeer::JOB_TYPE, BatchJobType::CONVERT, Criteria::EQUAL);
	$criteria->addAnd(BatchJobPeer::CREATED_AT, $minCreatedAtStr, Criteria::GREATER_EQUAL);
	$criteria->addAnd(BatchJobPeer::CREATED_AT, $currentTimeStr, Criteria::LESS_THAN);
	$criteria->addAnd(BatchJobPeer::QUEUE_TIME, $currentTimeStr, Criteria::LESS_THAN);
	$criteria->addAnd(BatchJobPeer::FINISH_TIME, $currentTimeStr, Criteria::GREATER_THAN);
	if ($PARAMETERS['simulatedSchedulerIds'] != 'all')
	{
		$criteria->addAnd(BatchJobPeer::LAST_SCHEDULER_ID, $PARAMETERS['simulatedSchedulerIds'], Criteria::IN);
	}
	$criteria->addAscendingOrderByColumn(BatchJobPeer::QUEUE_TIME);

	$batchJobs = BatchJobPeer::doSelect($criteria);
	
	return $batchJobs;
}

function printRunningJobsInfo($currentTime)
{
	$runningJobs = getRunningJobs($currentTime);
	$runningJobsCount = count($runningJobs);
	print("Running jobs\n=-=-=-=-=-=-=-=-=-=\n");
	print("count=$runningJobsCount\n");
	for ($dcIndex = 0; $dcIndex < 2; $dcIndex++)
	{
		print("=== DC $dcIndex\n");
		$dcJobCount = 0;
		foreach ($runningJobs as $runningJob)
		{
			if ($runningJob->getDc() != $dcIndex)
			{
				continue;
			}
			$dcJobCount++;
			$id = $runningJob->getId();
			$executionTimeLeft = $runningJob->getFinishTime(null) - $currentTime;
			print("	Job $id timeLeft=$executionTimeLeft\n");
		}
		print("	Count=$dcJobCount\n");
	} 
}

/********************************************************
 *		Statistics
 ********************************************************/
class Categorizer
{
	static function getCategories($batchJob, $isActualResults, $firstFlavorOfEntry = false)
	{
		global $PARAMETERS;
	
		if (array_key_exists('filterCallback', $PARAMETERS))
		{
			if (!call_user_func($PARAMETERS['filterCallback'], $batchJob))
			{
				return array();
			}
		}

		$categories = &$PARAMETERS['categories'];
		$result = array();
		$dc = $batchJob->getDc();
		if (in_array('all', $categories))
		{
			$result[] = 'all';
		}
		if (in_array('dc', $categories))
		{
			$result[] = "dc_$dc";
		}
		if (in_array('prio', $categories))
		{
			$prio = $batchJob->getPriority();
			$result[] = "prio_$prio";
		}
		if (in_array('dcprio', $categories))
		{
			$prio = $batchJob->getPriority();
			$result[] = "dc_{$dc}_prio_$prio";
		}
		if (in_array('duration', $categories))
		{
			$durationInMins = intval($batchJob->duration / 60);
			$durationGroup = null;
			foreach ($PARAMETERS['durationGroups'] as $curDuration)
			{
				if ($durationInMins < $curDuration)
				{
					$durationGroup = $curDuration;
					break;
				}
			}
			if ($durationGroup === null)
			{
				$result[] = 'duration_other';
			}
			else
			{
				$result[] = "duration_$durationGroup";
			}
		}
		if (in_array('time', $categories))
		{
			$dateInfo = getdate($batchJob->getCreatedAt(null));
			$result[] = sprintf('time_%s_%02d_%02d', $dc, $dateInfo['mday'], $dateInfo['hours']);
		}
		if (in_array('day', $categories))
		{
			$dateInfo = getdate($batchJob->getCreatedAt(null));
			$result[] = sprintf('day_%s_%04d_%02d_%02d', $dc, $dateInfo['year'], $dateInfo['mon'], $dateInfo['mday']);
		}
		$partnerId = $batchJob->getPartnerId();
		if (in_array("pid_$partnerId", $categories))
		{
			$result[] = "pid_$partnerId";
		}
		foreach ($categories as $cat)
		{
			if (substr($cat, 0, 7) == 'notpid_' && $cat != "notpid_$partnerId")
			{
				$result[] = $cat;
			}
		}
		if (in_array('ff', $categories) && 
			$firstFlavorOfEntry)
		{
			$ffCats = array();
			foreach ($result as $cat)
			{
				$ffCats[] = "{$cat}_FF";
			}
			$result = array_merge($result, $ffCats);
		}
		if (in_array('sched', $categories) &&
			$isActualResults)
		{
			$lastSchedId = $batchJob->getLastSchedulerId();
			$result[] = "sched_$lastSchedId";
		}
		return $result;
	}
}

class SimpleVariable
{
	function __construct()
	{
		$this->value = null;
	}
	
	function setValue($value)
	{
		$this->value = $value;
	}

	function getMeasures()
	{
		return array('value' => $this->value);
	}
}

class VariableAnalysis
{
	function __construct($histMinValue, $histMaxValue, $histResolution)
	{
		# min / max
		$this->minValue = null;
		$this->maxValue = null;
		
		# average
		$this->sampleCount = 0;
		$this->sampleSum = 0;
		
		# histogram
		$this->histogram = dictArray();
		$this->histMinValue = $histMinValue; 
		$this->histMaxValue = $histMaxValue;
		$this->histResolution = $histResolution;
	}
	
	function addSample($value, $weight=1)
	{
		# min / max
		if ($this->minValue === null || $value < $this->minValue)
		{
			$this->minValue = $value;
		}
		
		if ($this->maxValue === null || $value > $this->maxValue)
		{
			$this->maxValue = $value;
		}
		
		# average
		$this->sampleCount += $weight;
		$this->sampleSum += $value * $weight;

		# histogram
		if ($value < $this->histMinValue)
		{
			$histIndex = -1;
		}
		elseif ($value >= $this->histMaxValue)
		{
			$histIndex = $this->histResolution;
		}
		else
		{
			$histIndex = intval(($value - $this->histMinValue) * $this->histResolution / ($this->histMaxValue - $this->histMinValue));
		}

		if (array_key_exists($histIndex, $this->histogram))
		{
			$this->histogram[$histIndex] += $weight;
		}
		else
		{
			$this->histogram[$histIndex] = $weight;
		}
	}
	
	function getMeasures()
	{
		$result = dictArray();
		
		# min / max
		$result['min'] = $this->minValue;
		$result['max'] = $this->maxValue;
		
		# average
		$average = 0;
		if ($this->sampleCount != 0)
		{
			$average = $this->sampleSum / $this->sampleCount;
		} 
		$result['average'] = $average;
		$result['samples'] = $this->sampleCount;
		
		# histogram
		for ($maxIndex = $this->histResolution; $maxIndex >= -1 && !array_key_exists($maxIndex, $this->histogram); $maxIndex--); 
		
		$hist = '';
		for ($histIndex = -1; $histIndex <= $maxIndex; $histIndex++)
		{
			if (array_key_exists($histIndex, $this->histogram))
			{
				$curValue = $this->histogram[$histIndex];
			}
			else
			{
				$curValue = 0;
			}
			$hist .= "$curValue ";
		}
		$result['hist'] = $hist;
		
		return $result;
	}
}

class JobVariableSet
{
	function __construct($category)
	{
		$this->category = $category;
				
		$this->currentRunningJobs = 0;
		$this->lastRunningJobsUpdateTime = null;
		
		$this->currentQueuedJobs = 0;
		$this->lastQueuedJobsUpdateTime = null;

		$this->dummyJobCount = 0;
		
		$this->variables = array(
			'waitTime' => new VariableAnalysis(0, 20000, 100),
			'processTime' => new VariableAnalysis(0, 10000, 100),
			'completionTime' => new VariableAnalysis(0, 25000, 100),
			'relWaitTime' => new VariableAnalysis(0, 2000, 100),
			'relCompletionTime' => new VariableAnalysis(0, 4000, 400),
			'executionAttempts' => new VariableAnalysis(0, 10, 10),
			'runningJobs' => new VariableAnalysis(0, 100, 100),
			'queuedJobs' => new VariableAnalysis(0, 100, 100),
			'dummyJobQueueTime' => new SimpleVariable(),
			'dummyJobCompleteTime' => new SimpleVariable(),
		);
	}
	
	function updateRunningJobsCount($increment, $currentTime)
	{
		if ($this->lastRunningJobsUpdateTime !== null &&
			$currentTime > $this->lastRunningJobsUpdateTime)
		{
			$weight = $currentTime - $this->lastRunningJobsUpdateTime;
			$this->variables['runningJobs']->addSample($this->currentRunningJobs, $weight);
		}
		$this->currentRunningJobs += $increment;
		$this->lastRunningJobsUpdateTime = $currentTime;
	}

	function updateQueuedJobsCount($increment, $currentTime)
	{
		if ($this->lastQueuedJobsUpdateTime !== null &&
			$currentTime > $this->lastQueuedJobsUpdateTime)
		{
			$weight = $currentTime - $this->lastQueuedJobsUpdateTime;
			$this->variables['queuedJobs']->addSample($this->currentQueuedJobs, $weight);
		}
		$this->currentQueuedJobs += $increment;
		$this->lastQueuedJobsUpdateTime = $currentTime;
	}
	
	function notifyJobQueued($batchJob, $jobQueueTime)
	{
		global $currentTime, $PARAMETERS;
		
		$this->updateQueuedJobsCount(1, $jobQueueTime);

		if (array_key_exists('dummyPartnerId', $PARAMETERS) && 
			$batchJob->getPartnerId() == $PARAMETERS['dummyPartnerId'])
		{
			if ($this->dummyJobCount == 0)
			{
				$this->variables['dummyJobQueueTime']->setValue($currentTime);
			}
			$this->dummyJobCount++;
		}
	}
	
	function notifyJobStarted($batchJob, $jobStartTime)
	{
		$this->updateQueuedJobsCount(-1, $jobStartTime);
		$this->updateRunningJobsCount(1, $jobStartTime);
	}
	
	function notifyJobCompleted($batchJob, $jobStartTime, $jobEndTime)
	{
		global $currentTime, $PARAMETERS;
	
		$this->updateRunningJobsCount(-1, $jobEndTime);

		if (array_key_exists('dummyPartnerId', $PARAMETERS) && 
			$batchJob->getPartnerId() == $PARAMETERS['dummyPartnerId'])
		{
			$this->dummyJobCount--;
			if ($this->dummyJobCount == 0)
			{
				$this->variables['dummyJobCompleteTime']->setValue($currentTime);
			}
		}
		
		if ($jobStartTime > $batchJob->getCreatedAt(null))
		{
			$waitTime = $jobStartTime - $batchJob->getCreatedAt(null);
		}
		else
		{
			$waitTime = 0;
		}
		
		if ($jobEndTime > $jobStartTime)
		{
			$processTime = $jobEndTime - $jobStartTime;
		}
		else
		{
			$processTime = 0;
		}
		
		$completionTime = $waitTime + $processTime;
		if ($processTime >= $PARAMETERS['minProcessTime'])
		{
			$relWaitTime = $waitTime / $processTime;
		}
		else
		{
			$relWaitTime = $waitTime / $PARAMETERS['minProcessTime'];
		}
		
		if ($batchJob->duration >= $PARAMETERS['minDuration'])
		{
			$relCompletionTime = $completionTime / $batchJob->duration;
		}
		else
		{
			$relCompletionTime = $completionTime / $PARAMETERS['minDuration'];
		}

		$variables = array(
			'waitTime' => $waitTime,
			'processTime' => $processTime,
			'completionTime' => $completionTime,
			'relWaitTime' => $relWaitTime,
			'relCompletionTime' => $relCompletionTime,
			'executionAttempts' => $batchJob->getExecutionAttempts(),
			'duration' => $batchJob->duration,
		);
		
		if (array_key_exists('statsCallback', $PARAMETERS))
		{
			call_user_func(
				$PARAMETERS['statsCallback'], 
				$this->category,
				$batchJob,
				$variables);
		}

		foreach ($variables as $var => $value)
		{
			if (array_key_exists($var, $this->variables))
			{
				$this->variables[$var]->addSample($value);
			}
		}
	}
	
	function getVars()
	{
		return array_keys($this->variables);
	}

	function getMeasures($var)
	{
		if (!array_key_exists($var, $this->variables))
		{
			return dictArray();
		}
		return $this->variables[$var]->getMeasures();
	}
}

define('DAY_SECS', 60 * 60 * 24);

class SeenEntryIds
{
	function __construct()
	{
		$this->entryIdsQueue = dictArray();
		$this->lastQueueIndex = null;
	}

	function wasEntrySeen($entryId)
	{
		foreach (arrValues($this->entryIdsQueue) as $curQueue)
		{
			if (in_array($entryId, $curQueue))
			{
				return true;
			}
		}
		return false;
	}
	
	function addEntryId($entryId, $currentTime)
	{
		$timeInDays = intval($currentTime / DAY_SECS);
		$queueIndex = $timeInDays % 4;
		if ($this->lastQueueIndex !== $queueIndex)
		{
			$this->entryIdsQueue[$queueIndex] = array();
		}
		$this->entryIdsQueue[$queueIndex][] = $entryId;
		$this->lastQueueIndex = $queueIndex;
	}	
}

class Statistics
{
	function __construct($name)
	{
		$this->varSets = dictArray();
		$this->name = $name;
		$this->isActualResults = ($this->name == 'Actual');
		$this->seenEntryIds = new SeenEntryIds();
	}
	
	function notifyJobQueued($batchJob, $jobQueueTime)
	{
		$dc = $batchJob->getDc();
		$batchId = $batchJob->getId();
		debugLog("Stats {$this->name}: job queued queueTime=$jobQueueTime dc=$dc id=$batchId");
				
		$cats = Categorizer::getCategories($batchJob, $this->isActualResults);
		foreach ($cats as $cat)
		{
			if (!array_key_exists($cat, $this->varSets))
			{
				$this->varSets[$cat] = new JobVariableSet($cat);
			}
			
			$this->varSets[$cat]->notifyJobQueued($batchJob, $jobQueueTime);
		}
	}
	
	function notifyJobStarted($batchJob, $jobStartTime)
	{
		$dc = $batchJob->getDc();
		$batchId = $batchJob->getId();
		debugLog("Stats {$this->name}: job started startTime=$jobStartTime dc=$dc id=$batchId");
		$cats = Categorizer::getCategories($batchJob, $this->isActualResults);
		foreach ($cats as $cat)
		{
			if (!array_key_exists($cat, $this->varSets))
			{
				$this->varSets[$cat] = new JobVariableSet($cat);
			}
			
			$this->varSets[$cat]->notifyJobStarted($batchJob, $jobStartTime);
		}
	}
	
	function notifyJobCompleted($batchJob, $jobStartTime, $jobEndTime)
	{
		$dc = $batchJob->getDc();
		$batchId = $batchJob->getId();
		debugLog("Stats {$this->name}: job completed compTime=$jobEndTime dc=$dc id=$batchId");
		
		$firstFlavorOfEntry = false;
		$entryId = $batchJob->getEntryId();
		if (!$this->seenEntryIds->wasEntrySeen($entryId))
		{
			$this->seenEntryIds->addEntryId($entryId, $jobEndTime);
			$firstFlavorOfEntry = true;
		}
		
		$cats = Categorizer::getCategories($batchJob, $this->isActualResults, $firstFlavorOfEntry);
		foreach ($cats as $cat)
		{
			if (!array_key_exists($cat, $this->varSets))
			{
				$this->varSets[$cat] = new JobVariableSet($cat);
			}
			
			$this->varSets[$cat]->notifyJobCompleted($batchJob, $jobStartTime, $jobEndTime);
		}
	}
	
	function getCats()
	{
		return array_keys($this->varSets);
	}
	
	function getVars()
	{
		$result = array();
		foreach (arrValues($this->varSets) as $varSet)
		{
			$result = array_merge($result, $varSet->getVars());
		}
		return array_unique($result);
	}

	function getMeasures($cat, $var)
	{
		if (!array_key_exists($cat, $this->varSets))
		{
			return dictArray();
		}
		return $this->varSets[$cat]->getMeasures($var);
	}
}

/********************************************************
 *		Batch machines and data centers
 ********************************************************/
class BatchMachine
{
	function __construct($machineType)
	{
		$this->machineParams = dictArray();
		foreach (explode(',', $machineType) as $paramVal)
		{
			$explodedParamVal = explode('=', $paramVal);
			if (count($explodedParamVal) == 1)
			{
				$this->machineParams[$explodedParamVal[0]] = null;
			}
			elseif (count($explodedParamVal) == 2)
			{
				$this->machineParams[$explodedParamVal[0]] = $explodedParamVal[1];
			}
		}

		$this->minFileSize = intOrNull($this->machineParams, 'minFileSize');
		$this->maxFileSize = intOrNull($this->machineParams, 'maxFileSize');
		$this->minDuration = intOrNull($this->machineParams, 'minDuration');
		$this->maxDuration = intOrNull($this->machineParams, 'maxDuration');
		$this->maxPriority = intOrNull($this->machineParams, 'maxPriority');
		
		$this->curJob = null;
		$this->jobStartTime = null;
		$this->jobCompleteTime = null;
	}

	function isIdle()
	{
		return ($this->curJob === null);
	}

	function startJob($batchJob, $jobExecutionTimeCallback = null)
	{
		global $currentTime, $stats;
		
		assert($this->isIdle());

		if ($batchJob->getFinishTime(null) > $batchJob->getQueueTime(null))
		{
			$jobExecutionTime = $batchJob->getFinishTime(null) - $batchJob->getQueueTime(null);
		}
		else
		{
			$jobExecutionTime = 0;
		}
		if ($jobExecutionTimeCallback !== null)
		{
			$jobExecutionTime = $jobExecutionTimeCallback($batchJob, $jobExecutionTime);
		}
		$this->curJob = $batchJob;
		$this->jobStartTime = $currentTime;
		$this->jobCompleteTime = $currentTime + $jobExecutionTime;
		$stats->notifyJobStarted($batchJob, $this->jobStartTime);
	}

	function getNextCompleteTime()
	{
		return $this->jobCompleteTime;
	}

	function updateStatus()
	{
		global $currentTime, $stats;

		if ($this->jobCompleteTime === null)
		{
			return false;
		}

		if ($this->jobCompleteTime > $currentTime)
		{
			return false;
		}
		$stats->notifyJobCompleted($this->curJob, $this->jobStartTime, $this->jobCompleteTime);
		$this->curJob = null;
		$this->jobStartTime = null;
		$this->jobCompleteTime = null;
		return true;
	}

	function done()
	{
		assert($this->isIdle());
	}
}

class DataCenter
{
	function __construct($dcTopology, $dcIndex)
	{
		$this->machines = array();
		$this->idleMachines = array();
		$this->activeMachines = array();
		foreach ($dcTopology as $machineSpec)
		{
			for ($curInd = 0; $curInd < $machineSpec['count']; $curInd++)
			{
				$newMachine = new BatchMachine($machineSpec['type']);
				$this->machines[] = $newMachine;
				$this->idleMachines[] = $newMachine;
			}
		}
		$this->dcIndex = $dcIndex;
	}

	function getNextCompleteTime()
	{
		$result = null;
		foreach ($this->activeMachines as $batchMachine)
		{
			$curTime = $batchMachine->getNextCompleteTime();
			if ($curTime === null)
			{
				continue;
			}
			if ($result === null || $curTime < $result)
			{
				$result = $curTime;
			}
		}
		return $result;
	}

	function updateStatus()
	{
		for ($index = count($this->activeMachines) - 1; $index >= 0; $index--)
		{
			$batchMachine = &$this->activeMachines[$index];
			if ($batchMachine->updateStatus())
			{
				array_splice($this->activeMachines, $index, 1);
				$this->idleMachines[] = $batchMachine;
			}
		}
	}

	function done()
	{
		foreach ($this->machines as $batchMachine)
		{
			$batchMachine->done();
		}
	}
	
	function scheduleJobs($callback, $context)
	{
		for ($index = count($this->idleMachines) - 1; $index >= 0; $index--)
		{
			$batchMachine = &$this->idleMachines[$index];

			list($curJob, $continueLoop) = call_user_func($callback, $context, $this->dcIndex, $batchMachine);
			if ($curJob !== null)
			{
				$batchMachine->startJob($curJob);
				
				array_splice($this->idleMachines, $index, 1);
				$this->activeMachines[] = $batchMachine;
			}
			
			if (!$continueLoop)
			{
				break;
			}
		}
	}
}

class DataCenters
{
	function __construct($dcsTopology)
	{
		$this->dataCenters = dictArray();
		$this->name = $dcsTopology['name'];
		foreach ($dcsTopology as $dcIndex => $dcTopology)
		{
			if (!is_int($dcIndex))
			{
				continue;
			}
			$this->dataCenters[$dcIndex] = new DataCenter($dcTopology, $dcIndex);
		}
	}

	function getNextCompleteTime()
	{
		$result = null;
		foreach (arrValues($this->dataCenters) as $dataCenter)
		{
			$curTime = $dataCenter->getNextCompleteTime();
			if ($curTime === null)
			{
				continue;
			}
			if ($result === null || $curTime < $result)
			{
				$result = $curTime;
			}
		}
		return $result;
	}

	function updateStatus()
	{
		foreach (arrValues($this->dataCenters) as $dataCenter)
		{
			$dataCenter->updateStatus();
		}
	}

	function done()
	{
		foreach (arrValues($this->dataCenters) as $dataCenter)
		{
			$dataCenter->done();
		}
	}
}

/********************************************************
 *		Schedulers
 ********************************************************/
function getMatchingJobCB($curJob, $batchMachine)
{
	if ($batchMachine->minFileSize !== null && 
		$curJob->getFileSize() < $batchMachine->minFileSize)
	{
		return SortedArray::FAW_CONTINUE;
	}
	if ($batchMachine->maxFileSize !== null && 
		$curJob->getFileSize() > $batchMachine->maxFileSize)
	{
		return SortedArray::FAW_CONTINUE;
	}
	if ($batchMachine->minDuration !== null && 
		$curJob->duration < $batchMachine->minDuration)
	{
		return SortedArray::FAW_CONTINUE;
	}
	if ($batchMachine->maxDuration !== null && 
		$curJob->duration > $batchMachine->maxDuration)
	{
		return SortedArray::FAW_CONTINUE;
	}
	if ($batchMachine->maxPriority !== null && 
		$curJob->getPriority() > $batchMachine->maxPriority)
	{
		return SortedArray::FAW_CONTINUE;
	}
	
	return SortedArray::FAW_STOP_REMOVE;
}
 
function extractFirstMatchingJob(array &$queue, $batchMachine)
{
	for ($queueIndex = 0; $queueIndex < count($queue); $queueIndex++)
	{
		$curJob = &$queue[$queueIndex];

		if (getMatchingJobCB($curJob, $batchMachine) == FAW_CONTINUE)
		{
			continue;
		}
		
		array_splice($queue, $queueIndex, 1);
		return $curJob;
	}
	
	return null;
}

class ExistingJobScheduler
{
	function __construct(&$schedParams, &$dataCenters)
	{
		$this->jobQueue = array(
			0 => new SortedArray(staticCallback('ExistingJobScheduler', 'getJobPriority')),
			1 => new SortedArray(staticCallback('ExistingJobScheduler', 'getJobPriority')));
		$this->dataCenters = $dataCenters;
		if (array_key_exists('prio', $schedParams))
		{
			$this->prio = $schedParams['prio'];
		}
		else
		{
			$this->prio = false;
		}
	}

	static function getJobPriority($object, $context)
	{
		return $object->getPriority();
	}
	
	function queueJob($batchJob)
	{
		$dc = intval($batchJob->getDc());
		if ($this->prio)
		{
			$this->jobQueue[$dc]->insert($batchJob, $batchJob->getPriority() + 0.5);
		}
		else
		{
			$this->jobQueue[$dc]->insertTail($batchJob);
		}
	}

	function run()
	{
		foreach ($this->dataCenters->dataCenters as $dcIndex => $dataCenter)
		{
			$dataCenter->scheduleJobs(staticCallback('ExistingJobScheduler', 'queueJobs'), $this);
		}
	}
	
	static function queueJobs($scheduler, $dcIndex, $batchMachine)
	{	
		$curJob = $scheduler->jobQueue[$dcIndex]->walk(globalCallback('getMatchingJobCB'), $batchMachine);

		$continueLoop = ($scheduler->jobQueue[$dcIndex]->getCount() != 0);

		return array($curJob, $continueLoop);
	}

	function done()
	{
		foreach (arrValues($this->jobQueue) as $subQueue)
		{
			assert($subQueue->getCount() == 0);
		}
	}
}

class ShorterJobsFirstScheduler
{
	function __construct(&$schedParams, &$dataCenters)
	{
		$this->jobQueue = array(
			0 => new SortedArray(staticCallback('ShorterJobsFirstScheduler', 'getJobProcessTime')),
			1 => new SortedArray(staticCallback('ShorterJobsFirstScheduler', 'getJobProcessTime')));
		$this->dataCenters = $dataCenters;
	}
	
	static function getJobProcessTime($object, $context)
	{
		return $object->getFinishTime(null) - $object->getQueueTime(null);
	}

	function queueJob($batchJob)
	{
		$dc = intval($batchJob->getDc());
		$this->jobQueue[$dc]->insert($batchJob);
	}

	function run()
	{
		foreach ($this->dataCenters->dataCenters as $dcIndex => $dataCenter)
		{
			$dataCenter->scheduleJobs(staticCallback('ShorterJobsFirstScheduler', 'queueJobs'), $this);
		}
	}
	
	static function queueJobs($scheduler, $dcIndex, $batchMachine)
	{	
		$curJob = $scheduler->jobQueue[$dcIndex]->walk(globalCallback('getMatchingJobCB'), $batchMachine);

		$continueLoop = ($scheduler->jobQueue[$dcIndex]->getCount() != 0);

		return array($curJob, $continueLoop);
	}

	function done()
	{
		foreach (arrValues($this->jobQueue) as $subQueue)
		{
			assert($subQueue->getCount() == 0);
		}
	}
}

class ShorterVideosFirstScheduler
{
	function __construct(&$schedParams, &$dataCenters)
	{
		$this->prioFactors = valueOrNull($schedParams, 'prio');
		$this->jobQueue = array(
			0 => new SortedArray(staticCallback('ShorterVideosFirstScheduler', 'getVideoDuration'), $this->prioFactors),
			1 => new SortedArray(staticCallback('ShorterVideosFirstScheduler', 'getVideoDuration'), $this->prioFactors));
		$this->dataCenters = $dataCenters;
		$this->jobExecutionTimeCallback = valueOrNull($schedParams, 'jobExecutionTimeCallback');
		$this->queuedJobsPerPriority = array(0 => dictArray(), 1 => dictArray());
		$this->shortVideoDuration = 600;
		$this->queuedShortVideoJobs = array(0 => 0, 1 => 0);
	}
	
	static function getVideoDuration($object, $prioFactors)
	{
		if ($prioFactors === null)
		{
			return $object->duration;
		}
		else
		{
			return $object->duration * $prioFactors[$object->getPriority()];
		}
	}

	function queueJob($batchJob)
	{
		$dc = intval($batchJob->getDc());
		$prio = $batchJob->getPriority();
		if (array_key_exists($prio, $this->queuedJobsPerPriority[$dc]))
		{
			$this->queuedJobsPerPriority[$dc][$prio]++;
		}
		else
		{
			$this->queuedJobsPerPriority[$dc][$prio] = 1;
		}
		if ($batchJob->duration <= $this->shortVideoDuration)
		{
			$this->queuedShortVideoJobs[$dc]++;
		}
		if ($this->prioFactors !== null && $this->prioFactors[$prio] == 1000000)
		{
			$this->jobQueue[$dc]->insertTail($batchJob);
		}
		else
		{
			$this->jobQueue[$dc]->insert($batchJob);
		}
	}

	function run()
	{
		foreach ($this->dataCenters->dataCenters as $dcIndex => $dataCenter)
		{
			$dataCenter->scheduleJobs(staticCallback('ShorterVideosFirstScheduler', 'queueJobs'), $this);
		}
	}
	
	static function queueJobs($scheduler, $dcIndex, $batchMachine)
	{	
		$curQueue = &$scheduler->jobQueue[$dcIndex];
		
		# optimize max duration limitation
		$maxDuration = $batchMachine->maxDuration;
		if ($maxDuration !== null)					
		{
			if ($scheduler->prioFactors === null && $curQueue->getHead()->duration > $maxDuration)
			{
				return array(null, true);
			}
			if ($scheduler->shortVideoDuration == $maxDuration && $scheduler->queuedShortVideoJobs[$dcIndex] == 0)
			{
				return array(null, true);
			}
		}
		
		# optimize max priority limitation
		$maxPriority = $batchMachine->maxPriority;
		if ($maxPriority !== null)
		{
			$hasJobs = false;
			foreach ($scheduler->queuedJobsPerPriority[$dcIndex] as $prio => $jobCount)
			{
				if ($jobCount != 0 && $prio <= $maxPriority)
				{
					$hasJobs = true;
					break;
				}
			}
			if (!$hasJobs)
			{
				return array(null, true);
			}
		}

		# start a job
		$curJob = $curQueue->walk(globalCallback('getMatchingJobCB'), $batchMachine);
		if ($curJob !== null)
		{
			$scheduler->queuedJobsPerPriority[$dcIndex][$curJob->getPriority()]--;
			if ($curJob->duration <= $scheduler->shortVideoDuration)
			{
				$scheduler->queuedShortVideoJobs[$dcIndex]--;
			}
		}

		$continueLoop = ($scheduler->jobQueue[$dcIndex]->getCount() != 0);

		return array($curJob, $continueLoop);
	}

	function done()
	{
		foreach (arrValues($this->jobQueue) as $subQueue)
		{
			assert($subQueue->getCount() == 0);
		}
	}
}

class RelWaitTimeScheduler
{
	function __construct(&$schedParams, &$dataCenters)
	{
		$this->jobQueue = array(
			0 => array(),
			1 => array());
		$this->dataCenters = $dataCenters;
	}
	
	function queueJob($batchJob)
	{
		$dc = intval($batchJob->getDc());
		$this->jobQueue[$dc][] = $batchJob;
	}
	
	static function getHighestPriorityJobIndex($jobQueue)
	{
		global $currentTime, $PARAMETERS;
	
		$bestPriority = null;
		$bestIndex = null;
		for ($index = 0; $index < count($jobQueue); $index++)
		{
			$curJob = &$jobQueue[$index];
			if ($currentTime > $curJob->getCreatedAt(null))
			{
				$waitTime = $currentTime - $curJob->getCreatedAt(null);
			}
			else
			{
				$waitTime = 0;
			}
			if ($curJob->getFinishTime(null) > $curJob->getQueueTime(null) + $PARAMETERS['minProcessTime'])
			{
				$processTime = $curJob->getFinishTime(null) - $curJob->getQueueTime(null);
			}
			else
			{
				$processTime = $PARAMETERS['minProcessTime'];			
			}
			$curPriority = $waitTime / $processTime;

			if ($bestPriority === null || $curPriority > $bestPriority)
			{
				$bestIndex = $index;
				$bestPriority = $curPriority;
			}
		}
		
		return $bestIndex;
	}

	function run()
	{
		foreach ($this->dataCenters->dataCenters as $dcIndex => $dataCenter)
		{
			if (count($this->jobQueue[$dcIndex]) == 0)
			{
				continue;
			}
			$dataCenter->scheduleJobs(staticCallback('RelWaitTimeScheduler', 'queueJobs'), $this);
		}
	}
	
	static function queueJobs($scheduler, $dcIndex, $batchMachine)
	{	
		$curQueue = &$scheduler->jobQueue[$dcIndex];
		$bestIndex = self::getHighestPriorityJobIndex($curQueue);
		
		$curJob = $curQueue[$bestIndex];
		array_splice($curQueue, $bestIndex, 1);

		$continueLoop = (count($scheduler->jobQueue[$dcIndex]) != 0);

		return array($curJob, $continueLoop);
	}

	function done()
	{
		foreach (arrValues($this->jobQueue) as $subQueue)
		{
			assert(count($subQueue) == 0);
		}
	}
}

class DummyBatchJob
{
	function __construct($dc, $priority, $partnerId, $duration, $processingTime)
	{
		global $currentTime;
	
		$this->dc = $dc;
		$this->priority = $priority;
		$this->partnerId = $partnerId;
		$this->duration = $duration;
		$this->processingTime = $processingTime;
		$this->id = rand(1000000, 2000000);
		$this->entryId = rand(1000000, 2000000);
		$this->createdAt = $currentTime;
	}

	function getDc()
	{
		return $this->dc;
	}
	
	function getPriority()
	{
		return $this->priority;
	}
	
	function getPartnerId()
	{
		return $this->partnerId;
	}
	
	function getExecutionAttempts()
	{
		return 1;
	}
	
	function getId()
	{
		return $this->id; 
	}
	
	function getEntryId()
	{
		return $this->entryId; 
	}
	
	function getCreatedAt($ignore)
	{
		return $this->createdAt;
	}
	
	function getQueueTime($ignore)
	{
		return $this->getCreatedAt(null);
	}

	function getFinishTime($ignore)
	{
		return $this->getQueueTime(null) + $this->processingTime;
	}
	
	function getStatus()
	{
		return BatchJob::BATCHJOB_STATUS_FINISHED;
	}
}

/********************************************************
 *		Simulation / Playback
 ********************************************************/
class Simulation
{
	function __construct($simulation)
	{
		$this->dataCenters = new DataCenters($simulation['topology']);
		$scheduler = $simulation['scheduler'];
		$schedulerClass = $scheduler['class'];
		$this->scheduler = new $schedulerClass($scheduler, $this->dataCenters);
		$this->dummyJobsDetails = valueOrNull($simulation, 'dummyJobsDetails');
		$this->name = "{$scheduler['name']}/{$this->dataCenters->name}";
		if ($this->dummyJobsDetails !== null)
		{
			$this->name .= "/{$this->dummyJobsDetails['name']}";
		}
		$this->stats = new Statistics($this->name);
	}

	function queueDummyJobs($details)
	{
		global $currentTime, $PARAMETERS;

		$curTime = date('Y-m-d H:i:s');
		print("$curTime Queuing dummy jobs...\n");
		for ($dcIndex = 0; $dcIndex < 2; $dcIndex++)
		{
			for ($index = 0; $index < $details['jobCount']; $index++)
			{
				$duration = rand($details['minDuration'], $details['maxDuration']);
				$processingTime = $duration * rand($details['minProcessFactor'], $details['maxProcessFactor']);
				$curJob = new DummyBatchJob(
					$dcIndex, 
					$details['priority'], 
					$PARAMETERS['dummyPartnerId'], 
					$duration, 
					$processingTime);
				$this->stats->notifyJobQueued($curJob, $currentTime);
				$this->scheduler->queueJob($curJob);
			}
		}	
		$curTime = date('Y-m-d H:i:s');
		print($curTime." Queuing dummy jobs done...\n");
	}
	
	function run($batchJobs, $moreJobsLeft)
	{
		global $currentTime;

		$GLOBALS["stats"] = &$this->stats;

		$batchJobIndex = 0;

		for (;;)
		{
			# get next event time
			$eventTimes = array();
			if ($batchJobIndex < count($batchJobs))
			{
				$eventTimes[] = $batchJobs[$batchJobIndex]->getCreatedAt(null);
			}
			elseif ($moreJobsLeft)
			{
				return;
			}
		
			$nextCompleteTime = $this->dataCenters->getNextCompleteTime();
			if ($nextCompleteTime !== null)
			{
				$eventTimes[] = $nextCompleteTime;
			}
			
			$nextEventTime = null;
			foreach ($eventTimes as $eventTime)
			{
				if ($nextEventTime === null || $eventTime < $nextEventTime)
				{
					$nextEventTime = $eventTime;
				}
			}

			if ($nextEventTime === null)
			{
				break;
			}

			$currentTime = $nextEventTime;
			
			if ($this->dummyJobsDetails !== null &&
				$this->dummyJobsDetails['queueTime'] <= $currentTime)
			{
				$this->queueDummyJobs($this->dummyJobsDetails);
				$this->dummyJobsDetails = null;
			}
			
			# queue jobs that were already created
			while ($batchJobIndex < count($batchJobs) &&
				$batchJobs[$batchJobIndex]->getCreatedAt(null) <= $currentTime)
			{
				$curJob = $batchJobs[$batchJobIndex];
				$this->stats->notifyJobQueued($curJob, $currentTime);
				$this->scheduler->queueJob($curJob);
				$batchJobIndex++;
			}
				
			# update machine statuses
			$this->dataCenters->updateStatus();

			# run scheduling algorithm
			$this->scheduler->run();
		}

		$this->scheduler->done();
		$this->dataCenters->done();
	}

	function getVars()
	{
		return $this->stats->getVars();
	}
	
	function getCats()
	{
		return $this->stats->getCats();
	}
	
	function getMeasures($cat, $var)
	{
		return $this->stats->getMeasures($cat, $var);
	}
}

class ActualPlayback
{
	function __construct()
	{
		$this->stats = new Statistics('Actual');
		$this->pendingJobs = new SortedArray(staticCallback('ActualPlayback', 'getJobQueueTime'));
		$this->runningJobs = new SortedArray(staticCallback('ActualPlayback', 'getJobFinishTime'));
		$this->name = 'Actual results';
	}

	static function getJobQueueTime($object, $context)
	{
		return $object->getQueueTime(null);
	}

	static function getJobFinishTime($object, $context)
	{
		return $object->getFinishTime(null);
	}
	
	function addToPendingQueue($batchJob)
	{
		$this->pendingJobs->insert($batchJob);
	}

	function addToRunningQueue($batchJob)
	{
		$this->runningJobs->insert($batchJob);
	}
	
	function startJobs()
	{
		global $currentTime;
		
		while ($this->pendingJobs->getCount() != 0 &&
				$this->pendingJobs->getHead()->getQueueTime(null) <= $currentTime)
		{
			$selectedJob = $this->pendingJobs->removeHead();
			$this->stats->notifyJobStarted($selectedJob, $selectedJob->getQueueTime(null));
			$this->addToRunningQueue($selectedJob);
		}
	}
	
	function completeJobs()
	{
		global $currentTime;
		
		while ($this->runningJobs->getCount() != 0 &&
				$this->runningJobs->getHead()->getFinishTime(null) <= $currentTime)
		{
			$selectedJob = $this->runningJobs->removeHead();
			$this->stats->notifyJobCompleted($selectedJob, $selectedJob->getQueueTime(null), $selectedJob->getFinishTime(null));
		}
	}
	
	function run($batchJobs, $moreJobsLeft)
	{
		global $currentTime;
		
		if (count($batchJobs) == 0 && $moreJobsLeft)
		{
			return;
		}
		
		foreach ($batchJobs as $batchJob)
		{
			$this->stats->notifyJobQueued($batchJob, $currentTime);
			$this->addToPendingQueue($batchJob);
			$runUntil = $batchJob->getCreatedAt(null);
		}
		
		if (!$moreJobsLeft)
		{
			$runUntil = null;
		}
		
		for (;;)
		{
			# get next event time
			$nextEventTime = null;
			if ($this->pendingJobs->getCount() != 0)
			{
				$nextEventTime = $this->pendingJobs->getHead()->getQueueTime(null); 
			}
			if ($this->runningJobs->getCount() != 0)
			{
				$nextCompleteTime = $this->runningJobs->getHead()->getFinishTime(null);
				if ($nextEventTime === null || $nextCompleteTime < $nextEventTime)
				{
					$nextEventTime = $nextCompleteTime;
				}
			}
			if ($nextEventTime === null)
			{
				break;
			}
			
			if ($runUntil !== null && $nextEventTime > $runUntil)
			{
				return;
			}
			
			# start jobs that were queued and complete jobs that were finished
			$currentTime = $nextEventTime;
			
			$this->startJobs();
			$this->completeJobs();
		}
	}
	
	function getVars()
	{
		return $this->stats->getVars();
	}
	
	function getCats()
	{
		return $this->stats->getCats();
	}
	
	function getMeasures($cat, $var)
	{
		return $this->stats->getMeasures($cat, $var);
	}
}

/********************************************************
 *		Main
 ********************************************************/
function runSimulationCallback($batchJob) 
{
	global $simulations, $PARAMETERS;

	if ($batchJob->getQueueTime(null) === null ||
		$batchJob->getFinishTime(null) === null)
	{
		return;
	}
	
	$mediaInfo = mediaInfoPeer::retrieveByPK($batchJob->getData()->getMediaInfoId());
	if ($mediaInfo === null)
	{
		return;
	}
	
	$batchJob->duration = max($mediaInfo->getVideoDuration(), $mediaInfo->getContainerDuration());
    if ($batchJob->duration === null)
	{
        $batchJob->duration = 0;
	}
    else
	{
        $batchJob->duration /= 1000;
	}
	
	if (array_key_exists('manipulateJobsCallback', $PARAMETERS))
	{
		call_user_func($PARAMETERS['manipulateJobsCallback'], $batchJob);
	}
	
	$batchJobs = array($batchJob);
	foreach (arrValues($simulations) as $simulation)
	{
		$simulation->run($batchJobs, True);
	}
}

function createSimulations()
{
	global $PARAMETERS, $simulations;

	$simulations = dictArray();
	foreach ($PARAMETERS['simulations'] as $simulation)
	{
		if ($simulation == 'actual')
		{
			$curSimul = new ActualPlayback();
		}
		else
		{
			$curSimul = new Simulation($simulation);
		}
		
		$simulations[$curSimul->name] = $curSimul;
	}
}

function getVarsAndCats()
{
	global $simulations;

	$vars = array();
	$cats = array();
	foreach (arrValues($simulations) as $simulation)
	{
		$vars = array_merge($vars, $simulation->getVars());
		$cats = array_merge($cats, $simulation->getCats());
	}
	$vars = array_unique($vars, SORT_STRING);
	$cats = array_unique($cats, SORT_STRING);

	sort($vars);
	sort($cats);
	
	return array($vars, $cats);
}

function printResults($vars, $cats)
{
	global $simulations;

	foreach ($vars as $var)
	{
		print("$var\n===============\n");
		foreach ($cats as $cat)
		{
			if (endswith($cat, '_FF') && 
				in_array($var, array('runningJobs', 'queuedJobs')))
			{
				# these vars are not calced correctly for FF categories
				continue;
			}
			print("$var=>$cat\n=-=-=-=-=-=-=-=-=-=\n");
			foreach (arrValues($simulations) as $simulation)
			{
				print("{$simulation->name}\n--------------\n");
				$measures = $simulation->getMeasures($cat, $var);
				foreach ($measures as $name => $value)
				{
					print("$name: $value\n");
				}
				print("\n");
			}
		}
	}
	print("\n");
}
	
function simulationMain($parameters)
{
	global $PARAMETERS, $simulations;
	
	$PARAMETERS = $parameters;

	print("Started...\n");

	print(var_dump($parameters));
	print("\n");

	initializePropel();

	# create simulations
	createSimulations();

	# run simulations
	enumBatchJobs(
		$parameters['startTime'], 
		$parameters['endTime'], 
		globalCallback('runSimulationCallback'));

	foreach (arrValues($simulations) as $simulation)
	{
		$simulation->run(array(), False);
	}

	print("Done !\n\n");

	# get list of variables and categories
	list($vars, $cats) = getVarsAndCats();

	# print the report
	printRunningJobsInfo($parameters['startTime']);
	
	printResults($vars, $cats);
	
	return array($vars, $cats, $simulations);
}
