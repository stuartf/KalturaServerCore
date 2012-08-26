<?php

require_once('phpLibrary.php');
require_once('simulationEngine.php');

function filterBadJobs($batchJob)
{
	return ($batchJob->getStatus() == BatchJob::BATCHJOB_STATUS_FINISHED);
}

function jobExecutionTimeLimit($batchJob, $jobExecutionTime)
{
	$duration = max($batchJob->duration, 5 * 60);
	return min($jobExecutionTime, 15 * $duration);
}

$NEW_SCHEDULER = array(
	'name' => 'PrioSVF',
	'class' => 'ShorterVideosFirstScheduler',
	'prio' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 1000000),
	'jobExecutionTimeCallback' => globalCallback('jobExecutionTimeLimit'),
);

$NEW_TOPOLOGY = array(
	'name' => 'Existing',
	0 => array(
			array(
				'type' => 'linux', 
				'count' => 48,
			),
			array(
				'type' => 'linux,maxPriority=5', 
				'count' => 0,
			),
		),
	1 => array(
			array(
				'type' => 'linux', 
				'count' => 48,
			),
			array(
				'type' => 'linux,maxPriority=5', 
				'count' => 0,
			),
		),
	);

$DUMMY_PARTNER_ID = 87654321;
	
$LONG_DUMMY_MIGRATION_JOBS = array(
	'name' => 'longVidMigration',
	'queueTime' => mktime(0, 0, 0, 12, 24, 2010),
	'jobCount' => 4000,
	'minDuration' => 3600,
	'maxDuration' => 5400,
	'minProcessFactor' => 1,
	'maxProcessFactor' => 4,
	'priority' => 6, 
);

$SHORT_DUMMY_MIGRATION_JOBS = array(
	'name' => 'shortVidMigration',
	'queueTime' => mktime(0, 0, 0, 12, 24, 2010),
	'jobCount' => 80000,
	'minDuration' => 30,
	'maxDuration' => 300,
	'minProcessFactor' => 1,
	'maxProcessFactor' => 4,
	'priority' => 6, 
);
	
$SIMULATIONS = array(
	array('scheduler' => $NEW_SCHEDULER, 'topology' => $NEW_TOPOLOGY),
	array('scheduler' => $NEW_SCHEDULER, 'topology' => $NEW_TOPOLOGY, 'dummyJobsDetails' => $LONG_DUMMY_MIGRATION_JOBS),
	array('scheduler' => $NEW_SCHEDULER, 'topology' => $NEW_TOPOLOGY, 'dummyJobsDetails' => $SHORT_DUMMY_MIGRATION_JOBS),
);

$PARAMETERS = array(
	'startTime' => 				mktime(0, 0, 0, 12, 22, 2010),
	'endTime' => 				mktime(0, 0, 0, 1, 22, 2011),
	'simulatedSchedulerIds' => 	array(20, 40, 50, 60, 70, 80, 120, 140, 150, 160, 170, 180),
	'simulations' =>			$SIMULATIONS,
	'categories' =>				array("pid_$DUMMY_PARTNER_ID", "notpid_$DUMMY_PARTNER_ID"),
	'filterCallback' =>			globalCallback('filterBadJobs'),
	'minDuration' =>			60,
	'minProcessTime' =>			60,
	'debugLogEnabled' =>		false,
	'dummyPartnerId' =>			$DUMMY_PARTNER_ID,
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
