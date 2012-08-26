<?php

function filterBadJobs($batchJob)
{
	return ($batchJob->getStatus() == BatchJob::BATCHJOB_STATUS_FINISHED);
}

$SCHEDULERS = array('ExistingJobScheduler', 'ShorterVideosFirstScheduler');

$SIMULATIONS = array();
for ($machineCount = 32; $machineCount <= 80; $machineCount += 8)
{
	$curTopology = array('name' => "{$machineCount}_Machines");
	foreach (array(0, 1) as $dcIndex)
	{
		$curTopology[$dcIndex] = 
			array(
				array(
					'type' => 'linux', 
					'count' => $machineCount,
				),
			);
	} 
	
	foreach ($SCHEDULERS as $scheduler)
	{
		$SIMULATIONS[] = array('scheduler' => $scheduler, 'topology' => $curTopology);
	}
}

$PARAMETERS = array(
	'startTime' => 				mktime(0, 0, 0, 12, 7, 2010),
	'endTime' => 				mktime(0, 0, 0, 12, 17, 2010),
	'simulatedSchedulerIds' => 	'all',
	'simulations' =>			$SIMULATIONS,
	'categories' =>				array('dc'),
	'filterCallback' =>			globalCallback('filterBadJobs'),
	'minDuration' =>			60,
	'minProcessTime' =>			60,
	'debugLogEnabled' =>		false,
);

require_once('simulationEngine.php');

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
		print("CPUs\t");
		foreach ($cats as $cat)
		{
			print("$cat\t");
		}
		print("\n");
		
		for ($machineCount = 32; $machineCount <= 80; $machineCount += 8)
		{
			$simulation = $simulations["{$scheduler['name']}/{$machineCount}_Machines"];
			
			print("$machineCount\t");
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
