<?php

	/* ===========================
	 * KDLOperatorWrapper
	 */
class KDLOperatorWrapper extends KDLOperatorBase {
    public function __construct($id, $name=null, $sourceBlacklist=null, $targetBlacklist=null) {
    	$srcBlacklist = $sourceBlacklist;
		if(is_null($sourceBlacklist) && array_key_exists($id, KDLConstants::$TranscodersSourceBlackList)) {
			$srcBlacklist = KDLConstants::$TranscodersSourceBlackList[$id];
		}
		$trgBlacklist = $targetBlacklist;
		if(is_null($targetBlacklist) && array_key_exists($id, KDLConstants::$TranscodersTargetBlackList)) {
			$trgBlacklist = KDLConstants::$TranscodersTargetBlackList[$id];
		}
    	parent::__construct($id,$name,$srcBlacklist,$trgBlacklist);
    }

	public function GenerateCommandLine(KDLFlavor $predesign, KDLFlavor $target, $extra=null)
	{
		$cmdLineGenerator = $target->SetTranscoderCmdLineGenerator($predesign);

// The setting below seems to be redundant, since in the prev line the same vidBr is being set
//		if($target->_video)
//			$cmdLineGenerator->_vidBr = $target->_video->_bitRate;
		
		$params = new KDLOperationParams();
		$params->Set($this->_id, $extra);
		return $cmdLineGenerator->Generate($params, $predesign->_video->_bitRate);
	}
	
    /* ---------------------------
	 * CheckConstraints
	 */
	public function CheckConstraints(KDLMediaDataSet $source, KDLFlavor $target, array &$errors=null, array &$warnings=null)
	{
		if(parent::CheckConstraints($source, $target, $errors, $warnings)==true)
			return true;

		if($this->_id==KDLTranscoders::FFMPEG_AUX) {
			$transcoder = new KDLOperatorFfmpeg0_10($this->_id);
			if($transcoder->CheckConstraints($source, $target, $errors, $warnings)==true)
				return true;
		}
		
		if($this->_id==KDLTranscoders::FFMPEG) {
			$transcoder = new KDLOperatorFfmpeg($this->_id);
			if($transcoder->CheckConstraints($source, $target, $errors, $warnings)==true)
				return true;
		}
	
		
		if($this->_id==KDLTranscoders::MENCODER) {
			$transcoder = new KDLOperatorMencoder($this->_id);
			if($transcoder->CheckConstraints($source, $target, $errors, $warnings)==true)
				return true;
		}
	
		
		if($this->_id==KDLTranscoders::ON2) {
			$transcoder = new KDLOperatorOn2($this->_id);
			if($transcoder->CheckConstraints($source, $target, $errors, $warnings)==true)
				return true;
		}
	
		/*
		 * Remove encoding.com for DAR<>PAR
		 */
		if($this->_id==KDLTranscoders::ENCODING_COM
		&& $source->_video && $source->_video->_dar
		&& abs($source->_video->GetPAR()-$source->_video->_dar)>0.01) {
			$warnings[KDLConstants::VideoIndex][] = //"The transcoder (".$key.") can not process the (".$sourcePart->_id."/".$sourcePart->_format. ").";
				KDLWarnings::ToString(KDLWarnings::TranscoderFormat, $this->_id, "non square pixels");
			return true;
		}
			
		
		return false;	
	}
}


	/* ===========================
	 * KDLTranscoderCommand
	 */
class KDLTranscoderCommand {
	
			private $_design;
			private $_target;
			
			private $_vidId;
			private $_vidBr;
			private $_vidWid;
			private $_vidHgt;
			private $_vidFr;
			private $_vidGop;
			private $_vid2pass;
			private $_vidRotation;
			private $_vidScanType;
			
			private $_audId;
			private $_audBr; 
			private $_audCh;
			private $_audSr;
			
			private $_conId;
			
			private $_clipStart=null;
			private $_clipDur=null;
			
	public function KDLTranscoderCommand(KDLFlavor $design, KDLFlavor $target)
	{
		$this->_design = $design;
		$this->_target = $target;
		$this->setParameters($target);
	}
	
	/* ---------------------------
	 * setParameters
	 */
	private function setParameters(KDLFlavor $target)
	{
		if($target->_video){
			$this->_vidId = $target->_video->_id;
			$this->_vidBr = $target->_video->_bitRate;
			$this->_vidWid = $target->_video->_width;
			$this->_vidHgt = $target->_video->_height;
			$this->_vidFr = $target->_video->_frameRate;
			$this->_vidGop = $target->_video->_gop;
			$this->_vid2pass = $target->_isTwoPass;
			$this->_vidRotation = $target->_video->_rotation;
			$this->_vidScanType = $target->_video->_scanType;
		}
		else
			$this->_vidId="none";
			
		if($target->_audio){
			$this->_audId = $target->_audio->_id;
			$this->_audBr = $target->_audio->_bitRate;
			$this->_audCh = $target->_audio->_channels;
			$this->_audSr = $target->_audio->_sampleRate;
		}
		else
			$this->_audId="none";
			
		if($target->_container){
			$this->_conId = $target->_container->_id;
		}
		else
			$this->_conId="none";
			
		$this->_clipStart=$target->_clipStart;
		$this->_clipDur=$target->_clipDur;
	}
	
	/* ---------------------------
	 * Generate
	 */
	public function Generate(KDLOperationParams $transParams, $maxVidRate)
	{
		$cmd=null;
		switch($transParams->_id){
			case KDLTranscoders::KALTURA:
				$cmd=$transParams->_id;
				break;
			case KDLTranscoders::ON2:
				$cmd=$this->CLI_Encode($transParams->_extra);;
				break;
			case KDLTranscoders::FFMPEG:
				$cmd=$this->FFMpeg($transParams->_extra);
				break;
			case KDLTranscoders::MENCODER:
				$cmd=$this->Mencoder($transParams->_extra);
				break;
			case KDLTranscoders::ENCODING_COM:
				$cmd=$transParams->_id;
				break;
			case KDLTranscoders::FFMPEG_AUX:
			case KDLTranscoders::FFMPEG_VP8:
				$cmd=$this->FFMpeg_aux($transParams->_extra);
				break;
			case KDLTranscoders::EE3:
				$cmd=$this->EE3($transParams->_extra);
				break;
		}
		return $cmd;
	}
	
	/* ---------------------------
	 * FFMpeg
	 */
	public function FFMpeg($extra=null)
	{
		$transcoder = new KDLOperatorFfmpeg0_10(KDLTranscoders::FFMPEG); 
		return $transcoder->GenerateCommandLine($this->_design,  $this->_target,$extra);
	}

	/* ---------------------------
	 * Mencoder
	 */
	public function Mencoder($extra=null)
	{
		$transcoder = new KDLOperatorMencoder(KDLTranscoders::MENCODER); 
		return $transcoder->GenerateCommandLine($this->_design,  $this->_target,$extra);
	}

	/* ---------------------------
	 * CLI_Encode
	 */
	public function CLI_Encode($extra=null)
	{
		$transcoder = new KDLOperatorOn2(KDLTranscoders::ON2); 
		return $transcoder->GenerateCommandLine($this->_design,  $this->_target,$extra);
	}
	
	/* ---------------------------
	 * Encoding_com
	 */
	public function Encoding_com($extra=null)
	{
		return $this->CLI_Encode($extra);
	}

	/* ---------------------------
	 * FFMpeg_aux
	 */
	public function FFMpeg_aux($extra=null)
	{/**/
		$transcoder = new KDLOperatorFfmpeg(KDLTranscoders::FFMPEG_AUX); 
		return $transcoder->GenerateCommandLine($this->_design,  $this->_target,$extra);
	}

	/* ---------------------------
	 * EE3
	 */
	public function EE3($extra=null)
	{
		if($this->_conId!="none") {
			$pinfo = pathinfo(__FILE__);
			$dir = $pinfo['dirname'];
			switch($this->_conId){
				case KDLContainerTarget::ISMV:
					$xmlTemplate = $dir.'/ismPresetTemplate.xml';
					break;
				case KDLContainerTarget::MP4:
				case KDLContainerTarget::WMV:
				default:
					$xmlTemplate = $dir.'/wmvPresetTemplate.xml';
					break;
			}
			$xml = simplexml_load_file($xmlTemplate);
		}
		
		$xml->Job['OutputDirectory']=KDLCmdlinePlaceholders::OutDir;
		$xml->Job['DefaultMediaOutputFileName']=KDLCmdlinePlaceholders::OutFileName.".{DefaultExtension}";
		if($this->_vidId!="none"){
$vidProfile=null;
			switch($this->_vidId){
				case KDLVideoTarget::WMV2:
				case KDLVideoTarget::WMV3:
				case KDLVideoTarget::WVC1A:
				default:
					$vidProfile = $xml->MediaFile->OutputFormat->WindowsMediaOutputFormat->VideoProfile->AdvancedVC1VideoProfile;
					unset($xml->MediaFile->OutputFormat->WindowsMediaOutputFormat->VideoProfile->MainH264VideoProfile);					
					break;
				case KDLVideoTarget::H264:
				case KDLVideoTarget::H264B:
				case KDLVideoTarget::H264M:
				case KDLVideoTarget::H264H:				
					$vidProfile = $xml->MediaFile->OutputFormat->WindowsMediaOutputFormat->VideoProfile->MainH264VideoProfile;
					unset($xml->MediaFile->OutputFormat->WindowsMediaOutputFormat->VideoProfile->AdvancedVC1VideoProfile);					
					break;
			}
			$vFr = 30;
			if($this->_vidFr!==null && $this->_vidFr>0){
				$vFr = $this->_vidFr;
				$vidProfile['FrameRate']=$this->_vidFr;
			}
			if($this->_vidGop!==null && $this->_vidGop>0){
				$kFr = round($this->_vidGop/$vFr);
				$mi = round($kFr/60);
				$se = $kFr%60;
				$vidProfile['KeyFrameDistance']=sprintf("00:%02d:%02d",$mi,$se);
			}
			if($this->_vidBr){
				$this->_vidBr=max(100,$this->_vidBr); // The minimum video br for the SL is 100
				$vidProfile->Streams->StreamInfo->Bitrate->VariableConstrainedBitrate['PeakBitrate'] = round($this->_vidBr*1.3);
				$vidProfile->Streams->StreamInfo->Bitrate->VariableConstrainedBitrate['AverageBitrate'] = $this->_vidBr;
			}
			if($this->_vidWid!=null && $this->_vidHgt!=null){
				$vidProfile->Streams->StreamInfo['Size'] = $this->_vidWid.", ".$this->_vidHgt;
			}
			
//			$strmInfo = clone ($vidProfile->Streams->StreamInfo[0]);
//			KDLUtils::AddXMLElement($vidProfile->Streams, $vidProfile->Streams->StreamInfo[0]);
			
		}
		else {
			unset($xml->MediaFile->OutputFormat->WindowsMediaOutputFormat->VideoProfile);				
		}

		if($this->_audId!="none"){
$audProfile=null;
			switch($this->_audId){
				case KDLAudioTarget::WMA:
				default:
					$audProfile = $xml->MediaFile->OutputFormat->WindowsMediaOutputFormat->AudioProfile->WmaAudioProfile;
					unset($xml->MediaFile->OutputFormat->WindowsMediaOutputFormat->AudioProfile->AacAudioProfile);					
					break;
				case KDLAudioTarget::AAC:
					$audProfile = $xml->MediaFile->OutputFormat->WindowsMediaOutputFormat->AudioProfile->AacAudioProfile;
					unset($xml->MediaFile->OutputFormat->WindowsMediaOutputFormat->AudioProfile->WmaAudioProfile);					
					break;
			}
/*
	Since there are certain constraints on those values for the EE3 presets, 
	those values are set in the templates only
	
			if($this->_audBr!==null && $this->_audBr>0){
				$audProfile->Bitrate->ConstantBitrate['Bitrate'] = $this->_audBr;
			}
			if($this->_audSr!==null && $this->_audSr>0){
				$audProfile['SamplesPerSecond'] = $this->_audSr;
			}
			if($this->_audCh!==null && $this->_audCh>0){
				$audProfile['Channels'] = $this->_audCh;
			}
*/
		}
//$stream = clone $streams->StreamInfo;
//		$streams[1] = $stream;
		//		print_r($xml);
		return $xml->asXML();
	}

	
}

?>