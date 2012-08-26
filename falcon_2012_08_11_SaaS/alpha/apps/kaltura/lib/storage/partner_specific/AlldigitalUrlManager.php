<?php

class AlldigitalUrlManager extends kUrlManager
{

	const EXPIRY = 86400;
	
	/**
	 * (non-PHPdoc)
	 * @see kUrlManager::getFileSyncUrl()
	 */
	public function getFileSyncUrl(FileSync $fileSync)
	{
		$fileSync = kFileSyncUtils::resolve($fileSync);
		
		if ($this->protocol != StorageProfile::PLAY_FORMAT_HTTP)
		{
		    return;
		}
		
		$storagePartnerId = StorageProfilePeer::retrieveByPK($this->storageProfileId)->getPartnerId();
		
		$storagePartner = PartnerPeer::retrieveByPK($storagePartnerId);
		
		$fileName = $fileSync->getFilePath();

		$expiry = time() + self::EXPIRY;
		
		$url .= "?file=".$fileName. "&expire=".$expiry;
		
		$url .= "&key=". $this->getSecret($fileName, $storagePartner->getSecret(), $expiry);
		
		return $url;
		
	}
	
	public function getThumbnailAssetUrl($thumbAsset)
	{
		//TODO: Find out whether the implementation is necessary
	}
	
	/**
	 * 
	 * Function creates secret key for the file sync URL
	 * @param string $url
	 * @return string
	 */
	protected function getSecret ( $uri , $partnerSecret, $expiry)
	{
	    $token = $uri . $partnerSecret . $expiry;
	    
	    return md5($token);
	}
}