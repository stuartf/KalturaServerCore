<?php
/**
 * @package plugins.dol
 * @subpackage lib
 */
class KOperationEngineDol  extends KSingleOutputOperationEngine
{

	protected $taskConfig = null;

	public function __construct($cmd, $outFilePath)
	{
		parent::__construct($cmd,$outFilePath);
		KalturaLog::info(": cmd($cmd), outFilePath($outFilePath)");
	}

	protected function getCmdLine()
	{
		$exeCmd =  parent::getCmdLine();
		return $exeCmd;
	}

	public function configure(KSchedularTaskConfig $taskConfig, KalturaConvartableJobData $data, KalturaClient $client)
	{
		parent::configure($taskConfig, $data, $client);
		KalturaLog::info("taskConfig-->".print_r($taskConfig,true)."\ndata->".print_r($data,true));
		$this->taskConfig = $taskConfig;	
	}

	/**
	 * No params
	 */
	protected function doOperation()
	{
		if(!file_exists($this->inFilePath))
			throw new KOperationEngineException("File [$this->inFilePath] does not exist");

		$this->addToLogFile("Executed by [" . get_class($this) . "] on input file [$this->inFilePath]");
		$this->logMediaInfo($this->inFilePath);
				
	
		$start = microtime(true);
		$output = $this->doDolOperation();		
		$end = microtime(true);
	
		$duration = ( $end - $start );
						 
		$this->addToLogFile(get_class($this) . ": [$return_value] took [$duration] seconds", KalturaLog::INFO);
		$this->addToLogFile($output);
			
		if($return_value != 0) 
			throw new KOperationEngineException("return value: [$return_value]");
			
		$this->logMediaInfo($this->outFilesPath);
	}

	/**
	 * No params
	 */
	protected function doDolOperation()
	{
		$inFilePath = $this->inFilePath;
		$mappedCh1=7;
		$mappedCh2=8;
		
		KalturaLog::info(print_r($this,true));
		KalturaLog::info("operator==>".print_r($this->operator,1));
		KalturaLog::info("inFilePath==>$inFilePath");
		KalturaLog::info("outFilePath==>".$this->outFilePath);
			
		$paramsMap = KDLUtils::parseParamStr2Map($this->operator->extra);
KalturaLog::info("paramsMap==>".print_r($paramsMap,1));
		$mappedCh1 = $paramsMap["audio_ch1"];
		$mappedCh2 = $paramsMap["audio_ch2"];
KalturaLog::info("mappedCh1($mappedCh1),mappedCh2($mappedCh2)");
		if(!(isset($mappedCh1) && isset($mappedCh2))) {
			throw new KOperationEngineException("Missing audio channels mapping!");
		}
		
		// Get source medianfo to check for audio channels
		$medInfPrs = new KMediaInfoMediaParser($inFilePath,$this->taskConfig->params->mediaInfoCmd);
		$medInfObj = $medInfPrs->getMediaInfo();
		KalturaLog::info("mediaInfo==>".print_r($medInfObj,1));	
			// 
			// If no multiple channels 
			// or the required mepped channels are beyond the source audio channels - throw exception.
			// 
			// - No audio streams at all
		if(!array_key_exists("audio",$medInfObj->streamArray)) {
			throw new KOperationEngineException("No audio - can not map audio channels");
		}
			// - There is  just 1 audio stream get the channels number as a total audio channels count
		$audChCnt = count($medInfObj->streamArray["audio"]);
		$inOneStream = false;
		if($audChCnt<2) {
			$audChCnt = $medInfObj->streamArray["audio"][0]->audioChannels;
			$inOneStream = true;
		}
			// If the total number of channels is lower then the ids of the mapped channels - exit with exception
		if($audChCnt<$mappedCh1 && $audChCnt<$mappedCh2) {
			throw new KOperationEngineException("Not enough audio channels to map to asset audio - available ($audChCnt),mapped($mappedCh1,$mappedCh2)");
		}
		
		if($inOneStream) {
			$this->processInOneStream($medInfObj, $inFilePath, $mappedCh1, $mappedCh2);
		}
		else{
			$this->processMultipleStreams($medInfObj, $inFilePath, $mappedCh1, $mappedCh2);
		}
		
		return 0;
	}
	
	/**
	 * @param KalturaMediaInfo $medInfObj
	 * @param string $inFilePath
	 * @param int $mappedCh1
	 * @param int $mappedCh2
	 */
	private function processInOneStream($medInfObj, $inFilePath, $mappedCh1, $mappedCh2)
	{
		/**************************
		 *	Get the multi-channel audio stream and convert it to WAV
		 *
		 *	sample - ffmpeg -i Test.mxf -vn -acodec pcm_s16le -f wav Test.mxf.wav
		 */
		$cmdStr = $this->taskConfig->params->ffmpegCmd." -i $inFilePath -vn -acodec pcm_s16le -f wav ".$this->outFilePath."_sourceaudio.wav";
		KalturaLog::info("Retrieve audio cmdStr($cmdStr)");
		$this->executeCommandStr($cmdStr, "failed to get the multi-channel audio stream");

		/**************************
		 *	Get mapped audio streams out of the multi-channel audio WAV file
		 *
		 * sample - sox Test.mxf.wav Test.mxf.ch6.wav remix 6
		 */
		$cmdStr = $this->taskConfig->params->soxCmd." ".$this->outFilePath."_sourceaudio.wav ".$this->outFilePath."_ch".$mappedCh1.".wav remix $mappedCh1";
		KalturaLog::info("Get mapped audio stream cmdStr($cmdStr)");
		$this->executeCommandStr($cmdStr, "failed to get mapped audio stream ($mappedCh1)");
		$cmdStr = $this->taskConfig->params->soxCmd." ".$this->outFilePath."_sourceaudio.wav ".$this->outFilePath."_ch".$mappedCh2.".wav remix $mappedCh2";
		KalturaLog::info("Get mapped audio stream cmdStr($cmdStr)");
		$this->executeCommandStr($cmdStr, "failed to get mapped audio stream ($mappedCh2)");

		$this->mergeStreams($inFilePath, $mappedCh1, $mappedCh2);
		return;
		
		/**************************
		 *	Merge the mapped audio channels into WAV file
		 *
		 * sample  - sox -M dol/tmp/tPR_hP102848_pDC-010611_r1_ch01.wav -M dol/tmp/tPR_hP102848_pDC-010611_r1_ch02.wav tPR_hP102848_pDC-010611_r1.mixed.wav
		 */
		$cmdStr = $this->taskConfig->params->soxCmd;
		$cmdStr.= " -M ".$this->outFilePath."_ch".($mappedCh1).".wav";
		$cmdStr.= " -M ".$this->outFilePath."_ch".($mappedCh2).".wav";
		$cmdStr.= " -c 2 ".$this->outFilePath."_merged.wav";
		KalturaLog::info("Merge audio cmdStr($cmdStr)");
		$this->executeCommandStr($cmdStr, "failed to merge audio channels");
		

		/**************************
		 *	Merge the merged audio with the original video channel into a MOV file
		 *
		 * sample - ffmpeg -i /opt/kaltura/web//content/entry/data/4/267/0_i4t5zee3_0_lgbv4zjp_2.mp4 -i /opt/kaltura/tmp/convert/convert_0_i4t5zee3_6ed03_merged.wav -vcodec copy -acodec copy -f mov -y ~/anatol/mergetest.mov
		 */
		$cmdStr = $this->taskConfig->params->ffmpegCmd." -i $inFilePath";
		$cmdStr.= " -i ".$this->outFilePath."_merged.wav";
		$cmdStr.= " -vcodec copy -acodec copy -f mxf -y ".$this->outFilePath;
		KalturaLog::info("Merge video cmdStr($cmdStr)");
		$this->executeCommandStr($cmdStr, "failed to merge video and audio streams");
	}

	/**
	 * @param KalturaMediaInfo $medInfObj
	 * @param string $inFilePath
	 * @param int $mappedCh1
	 * @param int $mappedCh2
	 */
	private function processMultipleStreams($medInfObj, $inFilePath, $mappedCh1, $mappedCh2)
	{
		/**************************
		 *	Split the audio streams in to individual WAV files
		 */
		$cmdStr = $this->taskConfig->params->ffmpegCmd." -i $inFilePath";
		$ch=1;
		foreach ($medInfObj->streamArray["audio"] as $stream) {
		KalturaLog::info("stream(".print_r($stream,1).")");
			if($stream->audioChannels>1) {
				throw new KOperationEngineException("Bad audio stream - only 1channel are allowed for mappable stream");
			}
			$cmdStr .= " -acodec pcm_s16le -ar 44100 -f wav -y ".$this->outFilePath."_ch".$ch.".wav";
			$ch++;
		}
		KalturaLog::info("Split cmdStr($cmdStr)");
		$this->executeCommandStr($cmdStr, "failed to split audio channels");

		$this->mergeStreams($inFilePath, $mappedCh1, $mappedCh2);
		return;
		
		/**************************
		 *	Merge the mapped audio channels into WAV file
		 *
		 * sample  - sox -M dol/tmp/tPR_hP102848_pDC-010611_r1_ch01.wav -M dol/tmp/tPR_hP102848_pDC-010611_r1_ch02.wav tPR_hP102848_pDC-010611_r1.mixed.wav
		 */
		$cmdStr = $this->taskConfig->params->soxCmd;
		$cmdStr.= " -M ".$this->outFilePath."_ch".($mappedCh1).".wav";
		$cmdStr.= " -M ".$this->outFilePath."_ch".($mappedCh2).".wav";
		$cmdStr.= " -c 2 ".$this->outFilePath."_merged.wav";
		KalturaLog::info("Merge audio cmdStr($cmdStr)");
		$this->executeCommandStr($cmdStr, "failed to merge audio channels");
		

		/**************************
		 *	Merge the merged audio with the original video channel into a MOV file
		 *
		 * sample - ffmpeg -i /opt/kaltura/web//content/entry/data/4/267/0_i4t5zee3_0_lgbv4zjp_2.mp4 -i /opt/kaltura/tmp/convert/convert_0_i4t5zee3_6ed03_merged.wav -vcodec copy -acodec copy -f mov -y ~/anatol/mergetest.mov
		 */
		$cmdStr = $this->taskConfig->params->ffmpegCmd." -i $inFilePath";
		$cmdStr.= " -i ".$this->outFilePath."_merged.wav";
		$cmdStr.= " -vcodec copy -acodec copy -f mov -y ".$this->outFilePath;
		KalturaLog::info("Merge video cmdStr($cmdStr)");
		$this->executeCommandStr($cmdStr, "failed to merge video and audio streams");
	}

	/**
	 * @param string $inFilePath
	 * @param int $mappedCh1
	 * @param int $mappedCh2
	 */
	private function mergeStreams($inFilePath, $mappedCh1, $mappedCh2)
	{
		/**************************
		 *	Merge the mapped audio channels into WAV file
		 *
		 * sample  - sox -M dol/tmp/tPR_hP102848_pDC-010611_r1_ch01.wav -M dol/tmp/tPR_hP102848_pDC-010611_r1_ch02.wav tPR_hP102848_pDC-010611_r1.mixed.wav
		 */
		$cmdStr = $this->taskConfig->params->soxCmd;
		$cmdStr.= " -M ".$this->outFilePath."_ch".($mappedCh1).".wav";
		$cmdStr.= " -M ".$this->outFilePath."_ch".($mappedCh2).".wav";
		$cmdStr.= " -c 2 ".$this->outFilePath."_merged.wav";
		KalturaLog::info("Merge audio cmdStr($cmdStr)");
		$this->executeCommandStr($cmdStr, "failed to merge audio channels");
		

		/**************************
		 *	Merge the merged audio with the original video channel into a MOV file
		 *
		 * sample - ffmpeg -i /opt/kaltura/web//content/entry/data/4/267/0_i4t5zee3_0_lgbv4zjp_2.mp4 -i /opt/kaltura/tmp/convert/convert_0_i4t5zee3_6ed03_merged.wav -vcodec copy -acodec copy -f mov -y ~/anatol/mergetest.mov
		 */
		$cmdStr = $this->taskConfig->params->ffmpegCmd." -i $inFilePath";
		$cmdStr.= " -i ".$this->outFilePath."_merged.wav";
		$cmdStr.= " -vcodec copy -acodec copy -f mov -y ".$this->outFilePath;
		KalturaLog::info("Merge video cmdStr($cmdStr)");
		$this->executeCommandStr($cmdStr, "failed to merge video and audio streams");
	}
	
	/**
	 * @param string $cmdStr
	 * @param string $errMsg
	 */
	private function executeCommandStr($cmdStr, $errMsg)
	{
		$rvOutput=array();
		$rvInt=1000;
		$rvStr=exec("$cmdStr 2>&1",$rvOutput,&$rvInt);
		KalturaLog::info("rvStr($rvStr),rvInt($rvInt)");
		file_put_contents ($this->outFilePath.".log", $rvOutput, FILE_APPEND);
		if($rvInt) {
			throw new KOperationEngineException("$errMsg - rv($rvInt), desc($rvStr)");
		}
	}
}
