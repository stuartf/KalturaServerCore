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
	
$EXISTING_SCHEDULER_NO_PRIO = array(
	'name' => 'FCFS',
	'class' => 'ExistingJobScheduler',
);

$EXISTING_SCHEDULER_WITH_PRIO = array(
	'name' => 'PrioFCFS',
	'class' => 'ExistingJobScheduler',
	'prio' => true,
);

$SHORTER_FIRST_NO_PRIO = array(
	'name' => 'SVF',
	'class' => 'ShorterVideosFirstScheduler',
);

$SHORTER_FIRST_WITH_PRIO = array(
	'name' => 'PrioSVF',
	'class' => 'ShorterVideosFirstScheduler',
	'prio' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5),
);

$SIMULATIONS = array(
	'actual', 
	array(	'scheduler' => $EXISTING_SCHEDULER_NO_PRIO,		'topology' => $UNLIMITED_ONLY_TOPOLOGY	), 
	array(	'scheduler' => $EXISTING_SCHEDULER_WITH_PRIO,	'topology' => $UNLIMITED_ONLY_TOPOLOGY	), 
	array(	'scheduler' => $SHORTER_FIRST_NO_PRIO,			'topology' => $UNLIMITED_ONLY_TOPOLOGY	), 
	array(	'scheduler' => $SHORTER_FIRST_WITH_PRIO,		'topology' => $UNLIMITED_ONLY_TOPOLOGY	), 
);

$PARAMETERS = array(
	'startTime' => 				mktime(0, 0, 0, 12, 22, 2010),
	'endTime' => 				mktime(0, 0, 0, 1, 22, 2011),
	'simulatedSchedulerIds' => 	array(50, 60, 70, 80, 150, 160, 170, 180),
	'simulations' =>			$SIMULATIONS,
	'categories' =>				array('prio'),
	'filterCallback' =>			globalCallback('filterBadJobs'),
	'minDuration' =>			60,
	'minProcessTime' =>			60,
	'debugLogEnabled' =>		false,
);

list($vars, $cats, $simulations) = simulationMain($PARAMETERS);

print("XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX\n");

foreach ($vars as $var)
{
	# print column header
	print("$var\t");
	foreach ($cats as $cat)
	{
		print("$cat\t");
	}
	print("\n");
	
	# print data
	foreach (arrValues($simulations) as $simulation)
	{
		print("{$simulation->name}\t");
		foreach ($cats as $cat)
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
