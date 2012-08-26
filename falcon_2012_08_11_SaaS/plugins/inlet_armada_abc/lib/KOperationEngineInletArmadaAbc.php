<?php
/**
 * 
 * @package Scheduler
 * @subpackage Conversion
 *
 */
class KOperationEngineInletArmadaAbc extends KSingleOutputOperationEngine
{
	/**
	* @var KSchedularTaskConfig
	*/
	protected $taskConfig = null;
	
	/**
	* @var KalturaConvertJobData
	*/
	protected $data = null;

	/**
	* @var KalturaClient
	*/
	protected $client = null;

	/*
	protected $url=null;
	protected $login=null;
	protected $passw=null;
	protected $prio=5;
*/
	public function __construct($cmd, $outFilePath)
	{
		parent::__construct($cmd,$outFilePath);
//		$this->prio=5;
		KalturaLog::info(": cmd($cmd), outFilePath($outFilePath)");
	}

	/*************************************
	 * 
	 */
	protected function getCmdLine()
	{
		$exeCmd =  parent::getCmdLine();
		KalturaLog::info(print_r($this,true));
		return $exeCmd;
	}

	/*************************************
	 * 
	 */
	public function operate(kOperator $operator = null, $inFilePath, $configFilePath = null)
	{
		KalturaLog::debug(print_r($operator,1));

$encodingTemplateId=null;
$encodingTemplateName=null;
$cdnId = null;
$cloneAndUpadate=false;

			// ---------------------------------
			// Get Alldigital API session params from batch_config.ini
			//
		$url = $this->taskConfig->params->AlldigitalApiUrl;
		$user = $this->taskConfig->params->AlldigitalApiUser;
		$passw = $this->taskConfig->params->AlldigitalApiPassword;
		if($this->taskConfig->params->AlldigitalApiPriority)
			$priority = $this->taskConfig->params->AlldigitalApiPriority;
		else
			$priority = 2;
			//
			// ----------------------------------

			// ----------------------------------
			// Get Alldigital API session params flavor_params->extra
			//
		$paramsMap = KDLUtils::parseParamStr2Map($operator->extra);
		if(!array_key_exists ('priority', $paramsMap))
			$paramsMap['priority'] = $priority;
			//
			// ----------------------------------

			// ----------------------------------
			// Get 
			//
//		KalturaLog::debug("Big Bad client object(".print_r($this->client,1).")");
//		KalturaLog::debug("flavorParamsOutput(".$this->data->flavorParamsOutputId.")");
//		$fpOut=$this->client->flavorParamsOutput->get($this->data->flavorParamsOutputId);
		$fpOut=$this->data->flavorParamsOutput;
		if(!isset($fpOut)) {
			throw new KOperationEngineException("Missing flavorParamsOutput object for id(".$this->data->flavorParamsOutputId.")");
		}
//		$fpOut->setDescription("aaaaa");
		KalturaLog::debug("flavorParamsOutput::remoteStorageProfileIds(".$fpOut->remoteStorageProfileIds.")");
		$remoteStorageProfileId = (int)$fpOut->remoteStorageProfileIds;
		$storProf=$this->client->storageProfile->get($remoteStorageProfileId);
//KalturaLog::debug("storProf==>".print_r($storProf,1));
		if(!isset($storProf)) {
			throw new KOperationEngineException("Missing storageProfile object for id($remoteStorageProfileId)");
		}
		if(isset($storProf->systemName)){
			$paramsMap['deliverTemplateId'] = $storProf->systemName;
		}
		KalturaLog::debug("remoteStorageProfile object(".print_r($storProf,1).")");
			//
			// ----------------------------------

		$this->doAlldigitalAPI($url, $user, $passw, $storProf->storageUrl, $this->data->srcFileSyncLocalPath, $paramsMap);

	}

	/*************************************
	 * 
	 */
	private function doAlldigitalAPI($url, $user, $passw, $remoteStorageRoot, $adSrcFilePath, $paramsMap)
	{
$encodingTemplateId=null;
$packageTemplateId=null;
$deliverTemplateId=null;
$priority=null;
		foreach($paramsMap as $key=>$param){
			switch($key){
				case 'encodingTemplate':
				case 'encodingTemplateId':
					$encodingTemplateId=$param;
					break;
				case 'packageTemplateId':
					$packageTemplateId=$param;
					break;
				case 'deliverTemplateId':
					$deliverTemplateId=$param;
					break;
				case 'encodingTemplateName':
					$encodingTemplateName=$param;
					break;
				case 'priority':
					$priority=$param;
					break;
				case 'cloneAndUpadate':
					$cloneAndUpadate=$param;
					break;
				default:
					break;
			}
		}
		
		KalturaLog::debug("url($url), user($user), passw($passw), remoteStorageRoot($remoteStorageRoot), adSrcFilePath($adSrcFilePath), encodingTemplateId($encodingTemplateId), packageTemplateId($packageTemplateId), deliverTemplateId($deliverTemplateId), priority($priority)");
		$ad=new ADWorkflowAPI;
		$ad->setUser($user);
		$ad->setPassw($passw);
		$ad->setUrl($url);

KalturaLog::debug(print_r($ad,1));
		$err = null;
		
			// Evaluate AD in/out file path 
		$adOutFilePath = '%SOURCEFILE%_%BITRATE%';
		$err=null;
		$key=$ad->Create($adSrcFilePath, $adSrcFilePath, $adOutFilePath, $encodingTemplateId, $packageTemplateId, $deliverTemplateId, $priority, $err);
		if(!isset($key)) {
			throw new KOperationEngineException("AlldigitalApi failure: add job,err($err)");
		}
		KalturaLog::debug("jobAdd - encodingTemplateId($encodingTemplateId), inFile($adSrcFilePath), outFile($adOutFilePath), key($key)");
		
		$status = $this->waitForWorkflowPhase($ad, $key, 'encode');
		$encodedFile = (string)$status->data->item[0]->encode_content->item[0]->name;
		KalturaLog::debug("Encoding completed successfully! encodedFile($encodedFile)");
		
		$status = $this->waitForWorkflowPhase($ad, $key, 'package', 120);
		$packagedFile = (string)$status->data->item[0]->package_content->item[0]->name;
		KalturaLog::debug("Packaging completed successfully! packagedFile($packagedFile)");
		
		$status = $this->waitForWorkflowPhase($ad, $key, 'deliver', 120);
		KalturaLog::debug("Delivery completed successfully! packagedFile($packagedFile)");
		
		$cdnFolder = (string)$status->data->item[0]->cdn_url;
		$packagedFile = "$cdnFolder/$packagedFile";

		$customData=str_replace ("-", "/", $key);
		$customData="$customData/encode/$encodedFile";

		$this->data->destFileSyncLocalPath = $packagedFile;
		$this->data->customData = $customData;
	}
	
	/*************************************
	 * 
	 */
	private function waitForWorkflowPhase($ad, $key, $phase, $maxTime=0)
	{
		$err = null;
		$attemptCnt=0;
		$finished=false;
		$status=null;
		$timeInterval = 30;
		while ($finished==false) {
			sleep($timeInterval);
			$status=$ad->Status($key,$err);
			if(!$status) {
				throw new KOperationEngineException("Alldigital failure: workflow phase <$phase>, err(".print_r($err,1).")");
			}
			switch($phase){
			case 'encode':
				$phase_status = $status->data->item[0]->encode_status;
				break;
			case 'package':
				$phase_status = $status->data->item[0]->package_status;
				break;
			case 'deliver':
				$phase_status = $status->data->item[0]->deliver_status;
				break;
			}
			
			switch($phase_status){
			case AlldigitalAPIStatus::FINISHED:	// 2
				$finished=true;
				break;
			case AlldigitalAPIStatus::FAILED:	// 3
			case AlldigitalAPIStatus::DELETED:	// 4
				throw new KOperationEngineException("Alldigital failure: workflow phase <$phase>, status(".print_r($status,1).")");
				break;
			}
			$waited = ($attemptCnt+1)*$timeInterval;
			if($attemptCnt%10==0) {
				KalturaLog::debug("Alldigital workflow phase <$phase>: Waiting for completion - waited $waited sec, status-".print_r($status,1));
			}
			$attemptCnt++;
			if($maxTime>0 && $maxTime<$waited){
				KalturaLog::debug("Alldigital workflow phase <$phase>: Cancel waiting - reached the max wait time - $maxTime sec, status-".print_r($status,1));
				break;
			}
		}
		
		return $status;
	}
	
	/*************************************
	 * 
	 */
	public function configure(KSchedularTaskConfig $taskConfig, KalturaConvartableJobData $data, KalturaClient $client)
	{
		parent::configure($taskConfig, $data, $client);
		
		$this->taskConfig = $taskConfig;
		$this->data = $data;
		$this->client = $client;
		
		$errStr=null;
		if(!$taskConfig->params->AlldigitalApiUrl)
			$errStr="AlldigitalApiUrl";
		if(!$taskConfig->params->AlldigitalApiUser){
			if($errStr) 
				$errStr.=",";
			$errStr.="AlldigitalApiUser";
		}
		if(!$taskConfig->params->AlldigitalApiPassword){
			if($errStr) 
				$errStr.=",";
			$errStr.="AlldigitalApiPassword";
		}
		
		if($errStr)
			throw new KOperationEngineException("AlldigitalApi failure: missing credentials - $errStr");
		KalturaLog::info("taskConfig-->".print_r($taskConfig,true)."\ndata->".print_r($data,true));
	}

	/*************************************
	 * 
	 */
	private static function addLastSlashInFolderPath($pathStr, $slashCh)
	{
		if($pathStr[strlen($pathStr)-1]!=$slashCh)
			return $pathStr.$slashCh;
		else
			return $pathStr;
	}
	
}

