<?php
class kLocalPathUrlManager extends kUrlManager
{
	/**
	 * Returns the local path with no extension
	 * 
	 * @param FileSync $fileSync
	 * @return string
	 */
	public function getFileSyncUrl(FileSync $fileSync)
	{
		$fileSync = kFileSyncUtils::resolve($fileSync);
		
		$url = $fileSync->getFilePath();
		$url = str_replace('\\', '/', $url);
		
		if($this->protocol == StorageProfile::PLAY_FORMAT_RTMP)
			$url = preg_replace('/\.[\w]+$/', '', $url);

		if ($this->protocol == StorageProfile::PLAY_FORMAT_APPLE_HTTP)
			$url .= "/playlist.m3u8";
		
		return $url;
	}

	public function getFlavorAssetUrl(flavorAsset $flavorAsset)
	{
		$partnerId = $flavorAsset->getPartnerId();
		$subpId = $flavorAsset->getentry()->getSubpId();
		$partnerPath = myPartnerUtils::getUrlForPartner($partnerId, $subpId);
		$flavorAssetId = $flavorAsset->getId();
		
		$this->setFileExtension($flavorAsset->getFileExt());
		$this->setContainerFormat($flavorAsset->getContainerFormat());
	
		$url = "$partnerPath/serveFlavor/flavorId/$flavorAssetId";
		
		if($this->seekFromTime)
			$url .= "/seekFrom/$this->seekFromTime";
			
		if($this->clipTo)
			$url .= "/clipTo/$this->clipTo";
		
                if($this->protocol == StorageProfile::PLAY_FORMAT_RTMP)
		{
			$syncKey = $flavorAsset->getSyncKey(flavorAsset::FILE_SYNC_FLAVOR_ASSET_SUB_TYPE_ASSET);
			$fileSync = kFileSyncUtils::getReadyInternalFileSyncForKey($syncKey);
			$url = $this->getFileSyncUrl($fileSync);
			if ($this->extention && strtolower($this->extention) != 'flv' ||
                        	$this->containerFormat && strtolower($this->containerFormat) != 'flash video')	
			{
				$url = "mp4:$url";
			}
		}
		
		$url = str_replace('\\', '/', $url);
		return $url;
	}

}
