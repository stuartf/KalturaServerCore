<?php

class kMemcacheManager
{
	const MC_LOCAL = 1;
	const MC_GLOBAL_KEYS = 2;
	const MC_GLOBAL_QUERIES = 3;
	
	protected static $memcaches = array();
	
	protected static $memcacheConfigs = array(
		self::MC_LOCAL => 			array("memcache_host", 					"memcache_port"),
		self::MC_GLOBAL_KEYS => 	array("global_keys_memcache_host", 		"global_keys_memcache_port"),
		self::MC_GLOBAL_QUERIES => 	array("global_queries_memcache_host", 	"global_queries_memcache_port"),
	);
	
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

	/**
	 * @param string $hostName
	 * @param int $port
	 * @return Memcache or null on error
	 */
	protected static function connectToMemcache($hostName, $port)
	{
		if (!class_exists('Memcache'))
		{
			return null;
		}
		
		$connStart = microtime(true);
		
		for($i = 0; $i < 3; $i++)
		{
			$memcache = new Memcache;	
			
			//$memcache->setOption(Memcached::OPT_BINARY_PROTOCOL, true);			// TODO: enable when moving to memcached v1.3

			$curConnStart = microtime(true);
			$res = @$memcache->connect($hostName, $port);
			if ($res || microtime(true) - $curConnStart < .5)		// retry only if there's an error and it's a timeout error
				break;

			self::safeLog("got timeout error, retrying...");
		}

		self::safeLog("connect took - ". (microtime(true) - $connStart). " seconds to $hostName:$port");

		if (!$res)
		{
			self::safeLog("failed to connect to global memcache");
			return null;
		}
		
		return $memcache;
	}
	
	/**
	 * @param int $type
	 * @return Memcache or null on error
	 */
	public static function getMemcache($type)
	{
		if (array_key_exists($type, self::$memcaches))
		{
			return self::$memcaches[$type];
		}
		
		if (!array_key_exists($type, $memcacheConfigs))
		{
			return null;
		}
		
		list($hostParam, $portParam) = self::$memcacheConfigs[$type];
		if (!kConf::hasParam($hostParam) || !kConf::hasParam($portParam))
		{
			return null;
		}
		
		$memcache = self::connectToMemcache(kConf::get($hostParam), kConf::get($portParam));
		self::$memcaches[$type] = $memcache;
		return $memcache;
	}
}
