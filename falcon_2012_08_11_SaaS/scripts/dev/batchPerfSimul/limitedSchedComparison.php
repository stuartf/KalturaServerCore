<?php

require_once('phpLibrary.php');
require_once('simulationEngine.php');

function filterBadJobs($batchJob)
{
	return ($batchJob->getStatus() == BatchJob::BATCHJOB_STATUS_FINISHED);
}

$LIMITED_ONLY_TOPOLOGY = array(
	'name' => 'Limited linuxes',
	0 => array(
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
				'type' => 'linux,minFileSize=55000000', 
				'count' => 8,
			),
			array(
				'type' => 'linux,maxFileSize=60000000', 
				'count' => 8,
			),
		),
	);

$SCHEDULER = 
	array(
		'class' => 'ExistingJobScheduler', 
		'name' => 'FCFS',
		);
	
$SIMULATIONS = array(
	array(	'scheduler' => $SCHEDULER, 'topology' => $LIMITED_ONLY_TOPOLOGY	), 
	'actual', 
);

$PARAMETERS = array(
	'startTime' => 				mktime(0, 0, 0, 12, 22, 2010),
	'endTime' => 				mktime(0, 0, 0, 1, 22, 2011),
	'simulatedSchedulerIds' => 	array(20, 40, 120, 140),
	'simulations' =>			$SIMULATIONS,
	'categories' =>				array('all', 'dc'),
	'filterCallback' =>			globalCallback('filterBadJobs'),
	'minDuration' =>			60,
	'minProcessTime' =>			60,
	'debugLogEnabled' =>		false,
);

list($vars, $cats, $simulations) = simulationMain($PARAMETERS);
