<?php

/**
 * @package infra
 * @subpackage cache
 */
class kBaseCacheWrapper
{	
	/**
	 * @param string $key
	 * @return mixed or false on error
	 */
	abstract public function get($key);
	
	/**
	 * @param array $keys
	 * @return array or false on error
	 */
	public function multiGet($keys)
	{
		$result = array();
		foreach ($keys as $key)
		{
			$curResult = $this->get($key);
			if ($curResult !== false)
			{
				$result[$key] = $curResult;
			}
		}
		return $result;
	}

	/**
	 * @param string $key
	 * @param mixed $var
	 * @param int $expiry
	 */
	abstract public function set($key, $var, $expiry = 0);

	/**
	 * This function is required since this code can run before the autoloader
	 * 
	 * @param string $msg
	 */
	protected static function safeLog($msg)
	{
		if (class_exists('KalturaLog'))
			KalturaLog::debug($msg);
	}
}
