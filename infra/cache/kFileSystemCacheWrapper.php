<?php

require_once(dirname(__FILE__) . '/kBaseCacheWrapper.php');

/**
 * @package infra
 * @subpackage cache
 */
class kFileSystemCacheWrapper extends kBaseCacheWrapper
{
	protected $baseFolder;
	protected $baseFilename;
	protected $keyFolderChars;
	protected $serializeData;

	/**
	 * @param string $baseFolder
	 * @param string $baseFilename
	 * @param int $keyFolderChars
	 * @param bool $serializeData
	 * @return bool false on error
	 */
	public function init($baseFolder, $baseFilename, $keyFolderChars, $serializeData)
	{
		$this->baseFolder = rtrim($baseFolder, '/') . '/';
		$this->baseFilename = $baseFilename;
		$this->keyFolderChars = $keyFolderChars;
		$this->serializeData = $serializeData;
		return true;
	}
	
	/**
	 * @param string $key
	 * @return string
	 */
	protected function getFilePath($key)
	{
		$filePath = $this->baseFolder;
		if ($this->keyFolderChars)
			$filePath .= substr($key, 0, $this->keyFolderChars) . '/';
		return $this->baseFilename . $key;
	}

	/**
	 * @param string $filePath
	 */
	protected static function createDirForPath($filePath)
	{
		$dirname = dirname($filePath);
		if (!is_dir($dirname))
		{
			mkdir($dirname, 0777, true);
		}
	}
		
	/* (non-PHPdoc)
	 * @see kBaseCacheWrapper::get()
	 */
	public function get($key)
	{
		$filePath = $this->getFilePath($key);
		if (!file_exists($filePath))
			return false;
		$result = @file_get_contents($filePath);
		if ($result === false)
			return false;
		if ($this->serializeData)
			$result = @unserialize($result);
		return $result;
	}
		
	/* (non-PHPdoc)
	 * @see kBaseCacheWrapper::set()
	 */
	public function set($key, $var, $expiry = 0)
	{
		$filePath = $this->getFilePath($key);
		if ($this->serializeData)
			$var = serialize($var);
			
		self::createDirForPath($filePath);
		
		// write to a temp file and then rename, so that the write will be atomic
		$tempFilePath = tempnam(dirname($filePath), basename($filePath);
		file_put_contents($tempFilePath, $var);
		rename($tempFilePath, $filePath);
	}
}
