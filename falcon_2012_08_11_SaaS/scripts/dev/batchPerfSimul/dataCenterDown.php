<?php

require_once('phpLibrary.php');
require_once('simulationEngine.php');

function filterBadJobs($batchJob)
{
	return ($batchJob->getStatus() == BatchJob::BATCHJOB_STATUS_FINISHED);
}

function moveJobsToSingleDC($batchJob)
{
	$batchJob->setDc(0);
}

$ACTUAL_TOPOLOGY = array(
	'name' => 'Unlimited linuxes',
	0 => array(
			array(
				'type' => 'linux', 
				'count' => 48,
			),
		),
	1 => array(
			array(
				'type' => 'linux', 
				'count' => 48,
			),
		),
	);

$SIMULATIONS = array(
	array(	'scheduler' => array('class' => 'ShorterVideosFirstScheduler', 'name' => 'SVF'),	'topology' => $ACTUAL_TOPOLOGY	), 
);

$PARAMETERS = array(
	'startTime' => 				mktime(0, 0, 0, 1, 25, 2011),
	'endTime' => 				mktime(0, 0, 0, 2, 5, 2011),
	'simulatedSchedulerIds' => 	array(20, 40, 50, 60, 70, 80, 120, 140, 150, 160, 170, 180),
	'simulations' =>			$SIMULATIONS,
	'categories' =>				array('all', 'duration', 'prio', 'dc'),
	'filterCallback' =>			globalCallback('filterBadJobs'),
	'manipulateJobsCallback' => globalCallback('moveJobsToSingleDC'),
	'minDuration' =>			60,
	'minProcessTime' =>			60,
	'debugLogEnabled' =>		false,
	'durationGroups' => 		array(5,10,20,30,45,60,90),
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
