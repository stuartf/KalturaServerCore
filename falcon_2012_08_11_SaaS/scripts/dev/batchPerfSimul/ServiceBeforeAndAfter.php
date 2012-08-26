<?php

require_once('phpLibrary.php');
require_once('simulationEngine.php');

function filterBadJobs($batchJob)
{
	return ($batchJob->getStatus() == BatchJob::BATCHJOB_STATUS_FINISHED);
}

$EXISTING_SCHEDULER = array(
	'name' => 'PrioFCFS',
	'class' => 'ExistingJobScheduler',
	'prio' => true,
);

$EXISTING_TOPOLOGY = array(
	'name' => 'Existing',
	0 => array(
			array(
				'type' => 'linux', 
				'count' => 32,
			),
			array(
				'type' => 'linux,minFileSize=55000000', 
				'count' => 8,
			),
			array(
				'type' => 'linux,maxFileSize=60000000', 
				'count' => 8,
			),
		),
	1 => array(
			array(
				'type' => 'linux', 
				'count' => 32,
			),
			array(
				'type' => 'linux,minFileSize=55000000', 
				'count' => 8,
			),
			array(
				'type' => 'linux,maxFileSize=60000000', 
				'count' => 8,
			),
		),
	);

function jobExecutionTimeLimit($batchJob, $jobExecutionTime)
{
	$duration = max($batchJob->duration, 5 * 60);
	return min($jobExecutionTime, 15 * $duration);
}

$NEW_SCHEDULER = array(
	'name' => 'PrioSVF',
	'class' => 'ShorterVideosFirstScheduler',
	'prio' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5),
	'jobExecutionTimeCallback' => globalCallback('jobExecutionTimeLimit'),
);

$NEW_TOPOLOGY = array(
	'name' => 'Existing',
	0 => array(
			array(
				'type' => 'linux', 
				'count' => 40,
			),
			array(
				'type' => 'linux,maxDuration=600', 
				'count' => 8,
			),
		),
	1 => array(
			array(
				'type' => 'linux', 
				'count' => 44,
			),
			array(
				'type' => 'linux,maxDuration=600', 
				'count' => 4,
			),
		),
	);


$SIMULATIONS = array(
	'actual', 
	#array(	'scheduler' => $EXISTING_SCHEDULER,	'topology' => $EXISTING_TOPOLOGY	), 
	array(	'scheduler' => $NEW_SCHEDULER,		'topology' => $NEW_TOPOLOGY			),
);

$CATEGORIES = array(
	'dc', 
	'pid_17291',
	'pid_300',
	'pid_203822',
	'pid_291182',
	'pid_117232',
	'pid_351361',
	'pid_170422',
	'pid_113432',
	'pid_305482',
	'pid_47322',
	'ff',
);

$PARAMETERS = array(
	'startTime' => 				mktime(0, 0, 0, 12, 22, 2010),
	'endTime' => 				mktime(0, 0, 0, 1, 22, 2011),
	'simulatedSchedulerIds' => 	array(20, 40, 50, 60, 70, 80, 120, 140, 150, 160, 170, 180),
	'simulations' =>			$SIMULATIONS,
	'categories' =>				$CATEGORIES,
	'filterCallback' =>			globalCallback('filterBadJobs'),
	'minDuration' =>			60,
	'minProcessTime' =>			60,
	'debugLogEnabled' =>		false,
);

list($vars, $cats, $simulations) = simulationMain($PARAMETERS);

print("XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX\n");

foreach ($cats as $cat)
{
	# print column header
	print("$cat\t");
	foreach ($vars as $var)
	{
		print("$var\t");
	}
	print("\n");
	
	# print data
	foreach (arrValues($simulations) as $simulation)
	{
		print("{$simulation->name}\t");
		foreach ($vars as $var)
		{
			$measures = $simulation->getMeasures($cat, $var);
			if (array_key_exists('average', $measures))
			{
				print("{$measures['average']}\t");
			}
		}
		print("\n");
	}
}
