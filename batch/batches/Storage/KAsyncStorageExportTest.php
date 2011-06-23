<?php
/**
 * @package Scheduler
 * @subpackage Debug
 */
chdir(dirname( __FILE__ ) . "/../../");
require_once("bootstrap.php");
//require_once ("PHPUnit/TestCase.php");
/**
 * @package Scheduler
 * @subpackage Debug
 */
class KAsyncStorageExportTest extends PHPUnit_Framework_TestCase
{
	const JOB_NAME = 'KAsyncStorageExport';
	
	public function setUp() 
	{
		parent::setUp();
	}
	
	public function tearDown() 
	{
		parent::tearDown();
	}
	
	public function testGoodUrl()
	{
		$this->doTest('c:\web\content\r53v1\entry\data\60\382\1.flv', KalturaBatchJobStatus::FINISHED);
	}
	
	public function doTest($value, $expectedStatus)
	{
		$iniFile = "batch_config.ini";
		$schedulerConfig = new KSchedulerConfig($iniFile);
	
		$taskConfigs = $schedulerConfig->getTaskConfigList();
		$config = null;
		foreach($taskConfigs as $taskConfig)
		{
			if($taskConfig->name == self::JOB_NAME)
				$config = $taskConfig;
		}
		$this->assertNotNull($config);
		
		$jobs = $this->prepareJobs($value);
		
		$config->setTaskIndex(1);
		$instance = new $config->type($config);
		$instance->setUnitTest(true);
		$jobs = $instance->run($jobs); 
		$instance->done();
		
		foreach($jobs as $job)
			$this->assertEquals($expectedStatus, $job->status);
	}
	
	private function prepareJobs($value)
	{
		$data = new KalturaStorageExportJobData();
		$data->serverUrl = 'paramount.upload.akamai.com';
		$data->serverUsername = 'kaltura-paramount';
		$data->serverPassword = '3Mgy9X!!0';
		$data->ftpPassiveMode = true;
		$data->destFileSyncStoredPath = '/content/r47v1/entry/data/61/149/kaltura_test.flv';
		$data->srcFileSyncLocalPath	= $value;
		$job = new KalturaBatchJob();
		$job->id = 23;
		$job->status = KalturaBatchJobStatus::PENDING;
		$job->data = $data;
		
		return array($job);
	}
}

?>