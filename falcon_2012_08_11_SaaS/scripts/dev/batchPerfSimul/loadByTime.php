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
	array(	'scheduler' => array('class' => 'ExistingJobScheduler', 'name' => 'FCFS'),			'topology' => $UNLIMITED_ONLY_TOPOLOGY	), 
	array(	'scheduler' => array('class' => 'ShorterJobsFirstScheduler', 'name' => 'SJF'),		'topology' => $UNLIMITED_ONLY_TOPOLOGY	),
	array(	'scheduler' => array('class' => 'ShorterVideosFirstScheduler', 'name' => 'SVF'),	'topology' => $UNLIMITED_ONLY_TOPOLOGY	), 
	array(	'scheduler' => array('class' => 'RelWaitTimeScheduler', 'name' => 'RWT'),			'topology' => $UNLIMITED_ONLY_TOPOLOGY	),
	'actual', 
);

$PARAMETERS = array(
	'startTime' => 				mktime(0, 0, 0, 12, 7, 2010),
	'endTime' => 				mktime(0, 0, 0, 12, 17, 2010),
	'simulatedSchedulerIds' => 	array(50, 60, 70, 80, 150, 160, 170, 180),
	'simulations' =>			$SIMULATIONS,
	'categories' =>				array('time'),
	'filterCallback' =>			globalCallback('filterBadJobs'),
	'minDuration' =>			60,
	'minProcessTime' =>			60,
	'debugLogEnabled' =>		false,
);

list($vars, $cats, $simulations) = simulationMain($PARAMETERS);

print("XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX\n");

foreach ($vars as $var)
{
	if (in_array($var, array('executionAttempts')))
	{
		continue;
	}
	
	print("$var\n===============\n");
	for ($dc = 0; $dc < 2; $dc++)
	{
		print("dc_$dc\n-------\n");
		// print column headers
		foreach (arrValues($simulations) as $simulation)
		{
			print("{$simulation->name}\t");
		}
		print("\n");
		
		// print data
		foreach ($cats as $cat)
		{
			if (substr($cat, 0, 6) != 'time_'.$dc)
			{
				continue;
			}
			
			foreach (arrValues($simulations) as $simulation)
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
}
