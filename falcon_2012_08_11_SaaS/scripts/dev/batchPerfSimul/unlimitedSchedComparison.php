<?php

require_once('phpLibrary.php');
require_once('simulationEngine.php');

function filterBadJobs($batchJob)
{
	return ($batchJob->getStatus() == BatchJob::BATCHJOB_STATUS_FINISHED);
}

$UNLIMITED_ONLY_TOPOLOGY = array(
	'name' => 'Unlimited linuxes',
	0 => array(
			array(
				'type' => 'linux', 
				'count' => 32,
			),
		),
	1 => array(
			array(
				'type' => 'linux', 
				'count' => 32,
			),
		),
	);

$SIMULATIONS = array(
	'actual', 
	array(	'scheduler' => array('class' => 'ExistingJobScheduler', 'name' => 'FCFS'),			'topology' => $UNLIMITED_ONLY_TOPOLOGY	), 
	array(	'scheduler' => array('class' => 'ShorterJobsFirstScheduler', 'name' => 'SJF'),		'topology' => $UNLIMITED_ONLY_TOPOLOGY	),
	array(	'scheduler' => array('class' => 'ShorterVideosFirstScheduler', 'name' => 'SVF'),	'topology' => $UNLIMITED_ONLY_TOPOLOGY	), 
	array(	'scheduler' => array('class' => 'RelWaitTimeScheduler', 'name' => 'RWT'),			'topology' => $UNLIMITED_ONLY_TOPOLOGY	),
);

$PARAMETERS = array(
	'startTime' => 				mktime(0, 0, 0, 12, 22, 2010),
	'endTime' => 				mktime(0, 0, 0, 1, 22, 2011),
	'simulatedSchedulerIds' => 	array(50, 60, 70, 80, 150, 160, 170, 180),
	'simulations' =>			$SIMULATIONS,
	'categories' =>				array('all', 'dc', 'duration', 'ff'),
	'filterCallback' =>			globalCallback('filterBadJobs'),
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
