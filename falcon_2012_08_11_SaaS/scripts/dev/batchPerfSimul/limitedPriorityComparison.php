<?php

require_once('phpLibrary.php');
require_once('simulationEngine.php');

function filterBadJobs($batchJob)
{
	return ($batchJob->getStatus() == BatchJob::BATCHJOB_STATUS_FINISHED);
}

$SCHEDULERS = array(
	array(
		'class' => 'ShorterVideosFirstScheduler', 
		'name' => 'SVF',
		'prio' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5),
		),
	);

$SIMULATIONS = array();
for ($expressMachineCount = 1; $expressMachineCount < 4; $expressMachineCount++)
{
	$curTopology = array(
		'name' => "{$expressMachineCount}_Limited",
		0 => array(
				array(
					'type' => 'linux', 
					'count' => 48 - $expressMachineCount,
				),
				array(
					'type' => 'linux,maxPriority=2', 
					'count' => $expressMachineCount,
				),
			),
		1 => array(
				array(
					'type' => 'linux', 
					'count' => 48 - $expressMachineCount,
				),
				array(
					'type' => 'linux,maxPriority=2', 
					'count' => $expressMachineCount,
				),
			),
		);	

	foreach ($SCHEDULERS as $scheduler)
	{
		$SIMULATIONS[] = array('scheduler' => $scheduler, 'topology' => $curTopology);
	}
}

$PARAMETERS = array(
	'startTime' => 				mktime(0, 0, 0, 12, 7, 2010),
	'endTime' => 				mktime(0, 0, 0, 12, 17, 2010),
	'simulatedSchedulerIds' => 	array(20, 40, 50, 60, 70, 80, 120, 140, 150, 160, 170, 180),
	'simulations' =>			$SIMULATIONS,
	'categories' =>				array('dcprio'),
	'filterCallback' =>			globalCallback('filterBadJobs'),
	'minDuration' =>			60,
	'minProcessTime' =>			60,
	'debugLogEnabled' =>		false,
);

list($vars, $cats, $simulations) = simulationMain($PARAMETERS);

print("XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX\n");

foreach ($SCHEDULERS as $scheduler)
{
	print("$scheduler\n=================\n");
	
	foreach ($vars as $var)
	{
		if (in_array($var, array('executionAttempts')))
		{
			continue;
		}
		
		print("$var\n----------------\n");
		print("ECs\t");
		foreach ($cats as $cat)
		{
			print("$cat\t");
		}
		print("\n");
		
		for ($expressMachineCount = 1; $expressMachineCount < 4; $expressMachineCount++)
		{
			$simulation = $simulations["{$scheduler['name']}/{$expressMachineCount}_Limited"];
			
			print("$expressMachineCount\t");
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
}
