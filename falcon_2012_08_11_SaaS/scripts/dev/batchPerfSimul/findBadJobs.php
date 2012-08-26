<?php

require_once('phpLibrary.php');
require_once('simulationEngine.php');

$THRESHOLDS = array(
	'waitTime' => 50 * 3600,
	'processTime' => 20 * 3600,
	'completionTime' => 50 * 3600,
	'relWaitTime' => 1500,
	'relCompletionTime' => 1500,
);

function printBadJobs($category, $batchJob, $variables)
{
	global $THRESHOLDS, $savedTime;
	
	$duration = 5 * 60;
	if ($batchJob->duration > $duration)
	{
		$duration = $batchJob->duration;
	}
	if ($duration * 15 < $variables['processTime'])
	{
		if (!in_array($batchJob->getStatus(), array(BatchJob::BATCHJOB_STATUS_FATAL, BatchJob::BATCHJOB_STATUS_FAILED)))
		{
			print("Processed too long ".$batchJob->getId()."\n");
			print("\tstatus=".$batchJob->getStatus()."\n");
			print("\tprocessTime={$variables['processTime']}\n");
			print("\tduration=$duration\n");
			print("\tratio=".($variables['processTime'] / $duration)."\n");
		}
		else
		{
			$savedTime += ($variables['processTime'] - $duration * 15);
		}
	}
	
	$exceptions = array();
	foreach ($THRESHOLDS as $var => $thres)
	{
		if ($variables[$var] > $thres)
		{
			$exceptions[] = $var;
		}
	}
	if (count($exceptions) == 0)
	{
		return;
	}
	
	print("Bad job ".$batchJob->getId().":\n");
	foreach ($variables as $var => $value)
	{
		print("\t$var\t$value");
		if (in_array($var, $exceptions))
		{
			print("\t> {$THRESHOLDS[$var]}");
		}
		print("\n");
	}
}

$SIMULATIONS = array(
	'actual', 
);

$PARAMETERS = array(
	'startTime' => 				mktime(0, 0, 0, 1, 8, 2011),
	'endTime' => 				mktime(0, 0, 0, 1, 22, 2011),
	'simulatedSchedulerIds' => 	'all',
	'simulations' =>			$SIMULATIONS,
	'categories' =>				array('all'),
	'minDuration' =>			60,
	'minProcessTime' =>			60,
	'debugLogEnabled' =>		false,
	'statsCallback' => 			globalCallback('printBadJobs'),
);

$savedTime = 0;

list($vars, $cats, $simulations) = simulationMain($PARAMETERS);

print("Saved a total of $savedTime seconds\n");
