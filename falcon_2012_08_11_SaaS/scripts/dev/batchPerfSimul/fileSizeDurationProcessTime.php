<?php 

function initializePropel()
{
	$dbConfig = array (
	  'datasources' => 
		array (
			'default' => 'propel',	 
			'propel' => 
			array (
				'adapter' => 'mysql',
				'connection' => 
				array (
					'classname' => 'KalturaPDO',
					'phptype' => 'mysql',
					'database' => 'kaltura',
					'hostspec' => 'ilrepl.kaltura.dev',
					'user' => 'kaltura',
					'password' => 'kaltura',
					'dsn' => 'mysql:host=ilrepl.kaltura.dev;port=3306;dbname=kaltura;user=kaltura;password=kaltura;',
				),
			),
		),
	);

	Propel::setConfiguration($dbConfig);
	Propel::setLogger(KalturaLog::getInstance());
	Propel::initialize();
}

function enumBatchJobs($startTime, $endTime, $callback, $schedulerIds = 'all')
{
	for ($curTime = $startTime; $curTime < $endTime; $curTime = $nextTime)
	{
		$nextTime = ($curTime + 24 * 60 * 60);

		$queryStart = date('Y-m-d', $curTime);
		$queryEnd = date('Y-m-d', $nextTime);

		print(date('Y-m-d H:i:s')." Running query $queryStart - $queryEnd...\n");

		$criteria = new Criteria();
		$criteria->addAnd(BatchJobPeer::CREATED_AT, $queryStart, Criteria::GREATER_EQUAL);
		$criteria->addAnd(BatchJobPeer::CREATED_AT, $queryEnd, Criteria::LESS_THAN);
		$criteria->addAnd(BatchJobPeer::JOB_TYPE, BatchJobType::CONVERT, Criteria::EQUAL);
		if ($schedulerIds != 'all')
		{
			$criteria->addAnd(BatchJobPeer::LAST_SCHEDULER_ID, $schedulerIds, Criteria::IN);
		}
		
		$criteria->addAscendingOrderByColumn(BatchJobPeer::CREATED_AT);

		$batchJobs = BatchJobPeer::doSelect($criteria);

		print(date('Y-m-d H:i:s')." Processing ".count($batchJobs)." query results...\n");
		
		foreach ($batchJobs as $batchJob)
		{
			$callback($batchJob);
		}
		
		BatchJobPeer::clearInstancePool();
		mediaInfoPeer::clearInstancePool();
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
		$this->histogram = array();
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

		if (isset($this->histogram[$histIndex]))
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
		$result = array();
		
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
		for ($maxIndex = $this->histResolution; $maxIndex >= -1 && !isset($this->histogram[$maxIndex]); $maxIndex--); 
		
		$hist = '';
		for ($histIndex = -1; $histIndex <= $maxIndex; $histIndex++)
		{
			if (isset($this->histogram[$histIndex]))
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

define('MEGA', 1048576);

function runSimulationCallback($batchJob) 
{
	global $resultTable;

	if ($batchJob->getQueueTime(null) === null ||
		$batchJob->getFinishTime(null) === null ||
		$batchJob->getStatus() != BatchJob::BATCHJOB_STATUS_FINISHED)
	{
		return;
	}
	
	$mediaInfo = mediaInfoPeer::retrieveByPK($batchJob->getData()->getMediaInfoId());
	if ($mediaInfo === null)
	{
		return;
	}
	
	$duration = max($mediaInfo->getVideoDuration(), $mediaInfo->getContainerDuration()) / 1000;	
	$fileSize = $batchJob->getFileSize();
	$processTime = $batchJob->getFinishTime(null) - $batchJob->getQueueTime(null);
	
	if ($duration <= 0 || $fileSize <= 0 || $processTime <= 0)
	{
		return;
	}
	
	$resultTable['size-mb/duration']->addSample(($fileSize / MEGA) / $duration);
	$resultTable['pt/duration']->addSample($processTime / $duration);
	$resultTable['pt/size-mb']->addSample($processTime / ($fileSize / MEGA));
}

function totalProcessingTimeCallback($batchJob) 
{
	global $totalProcessTime;

	if ($batchJob->getQueueTime(null) === null ||
		$batchJob->getFinishTime(null) === null)
	{
		return;
	}
	
	$processTime = $batchJob->getFinishTime(null) - $batchJob->getQueueTime(null);
	if ($processTime <= 0)
	{
		return;
	}
	
	$totalProcessTime[$batchJob->getDc()] += $processTime;
}

ini_set("memory_limit", "2048M");

require_once('/opt/kaltura/app/api_v3/bootstrap.php');

error_reporting(E_ALL);

initializePropel();

$startTime = mktime(0, 0, 0, 1, 1, 2011);
$endTime = mktime(0, 0, 0, 2, 1, 2011);

////////////////////////////////////////////
$totalProcessTime = array('0' => 0, '1' => 0);

enumBatchJobs($startTime, $endTime, 'totalProcessingTimeCallback', array(50, 60, 70, 80, 150, 160, 170, 180));

foreach ($totalProcessTime as $dc => $processTime)
{
	$avgRunningJobs = ($processTime / ($endTime - $startTime));
	print("Avg running jobs, DC$dc: $avgRunningJobs\n");
}

////////////////////////////////////////////
$resultTable = array(
	'size-mb/duration' => new VariableAnalysis(0, 1.5, 250),
	'pt/duration' => new VariableAnalysis(0, 3, 250),
	'pt/size-mb' => new VariableAnalysis(0, 10, 250),
);

enumBatchJobs($startTime, $endTime, 'runSimulationCallback');

foreach ($resultTable as $var => $analysis)
{
	print("$var\n==========\n");
	$measures = $analysis->getMeasures();
	foreach ($measures as $name => $value)
	{
		print("$name: $value\n");
	}
}
