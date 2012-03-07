<?php

ini_set ( "memory_limit", "512M" );

require_once("bootstrap.php");

/**
 * Executes the KAsyncDropFolderWatcher
 * 
 * @package plugins.dropFolder
 * @subpackage Scheduler
 */

$instance = new KAsyncDropFolderWatcher();
$instance->run(); 
$instance->done();
