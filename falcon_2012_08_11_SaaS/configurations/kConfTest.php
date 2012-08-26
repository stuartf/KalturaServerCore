<?php
if(isset($argv[1]))
	$_SERVER["HOSTNAME"] = $argv[1];
	
//$_SERVER["HOSTNAME"] = 'ny-apache2';

define('ROOT_DIR', dirname(__FILE__) . '/../');
require_once(ROOT_DIR . 'alpha/config/kConf.php');
require_once(ROOT_DIR . 'infra/bootstrap_base.php');
require_once(ROOT_DIR . 'infra/KAutoloader.php');

KAutoloader::register();

class kConfNew
{
	const APC_CACHE_MAP = 'kConf';
	
	protected static $map = null;
	
	private static function init()
	{
		if (self::$map) 
			return;
		
		$configDir = realpath(dirname(__file__) . '/../configurations');
		
		self::$map = array();
		if(function_exists('apc_exists') && apc_exists(self::APC_CACHE_MAP))
		{
			// existence of base.reload file means that the kConf should be reloaded from the file
			if(file_exists("$configDir/base.reload"))
			{
				if(apc_delete(self::APC_CACHE_MAP))
				{
					$deleted = unlink("$configDir/base.reload");
					error_log("Base configuration reloaded");
					if(!$deleted)
						error_log("Failed to delete base.reload file");
				}
				else 
				{
					error_log("Failed to reload configuration, APC cache not deleted");
				}
			}
			else
			{
				self::$map = apc_fetch(self::APC_CACHE_MAP);
				if(self::$map)
					return;
			}
		}
		
		if(!file_exists("$configDir/base.ini"))
		{
			error_log("Base configuration not found [$configDir/base.ini]");
			die("Base configuration not found [$configDir/base.ini]");
		}
		$config = parse_ini_file("$configDir/base.ini", true);
	
		if(!file_exists("$configDir/local.ini"))
		{
			error_log("Local configuration not found [$configDir/local.ini]");
			die("Local configuration not found [$configDir/local.ini]");
		}		
		$localConfig = parse_ini_file("$configDir/local.ini", true);
		$config = self::mergeConfigItem($config, $localConfig);
		
		$hostname = (isset($_SERVER["HOSTNAME"]) ? $_SERVER["HOSTNAME"] : gethostname());
		if($hostname)
		{
			$localConfigFile = "$hostname.ini";
			
			$configPath = "$configDir/hosts";
			$configDir = dir($configPath);
			while (false !== ($iniFile = $configDir->read())) 
			{
				$iniFileMatch = str_replace('#', '*', $iniFile);
				if(!fnmatch($iniFileMatch, $localConfigFile))
					continue;
					
				$localConfig = parse_ini_file("$configPath/$iniFile", true);
				$config = self::mergeConfigItem($config, $localConfig);
			}
			$configDir->close();
		}
			
		self::$map = $config;
		
		if(function_exists('apc_store'))
			apc_store(self::APC_CACHE_MAP, self::$map);
	}
	
	public static function getAll()
	{
		self::init();
		
		if(self::hasMap('dc_config'))
			self::getMap('dc_config');
			
		if(self::hasMap('v3cache_getfeed_expiry'))
			self::getMap('v3cache_getfeed_expiry');
			
		if(self::hasMap('v3cache_ignore_admin_ks'))
			self::getMap('v3cache_ignore_admin_ks');
			
		if(self::hasMap('optimized_playback'))
			self::getMap('optimized_playback');
			
		if(self::hasMap('url_managers'))
			self::getMap('url_managers');
			
		return self::$map;
	}
		
	public static function hasMap($mapName)
	{
		self::init();
		
		if($mapName == 'local')
			return true;
		
		if(isset(self::$map[$mapName]))
			return true;
		
		$configDir = realpath(dirname(__file__) . '/../configurations');
		return file_exists("$configDir/$mapName.ini");
	}
		
	public static function getMap($mapName)
	{
		self::init();
		
		if($mapName == 'local')
			return self::$map;
		
		if(isset(self::$map[$mapName]))
			return self::$map[$mapName];
		
		$configDir = realpath(dirname(__file__) . '/../configurations');
		if(!file_exists("$configDir/$mapName.ini"))
			throw new Exception("Cannot find map [$mapName] in config folder");
		
		$config = new Zend_Config_Ini("$configDir/$mapName.ini");
		self::$map[$mapName] = $config->toArray();
	
		$hostname = (isset($_SERVER["HOSTNAME"]) ? $_SERVER["HOSTNAME"] : gethostname());
		if($hostname)
		{
			$localConfigFile = "$hostname.ini";
			
			$configPath = "$configDir/hosts/$mapName";
			if(file_exists($configPath) && is_dir($configPath)){			
				$configDir = dir($configPath);
				while (false !== ($iniFile = $configDir->read())) 
				{
					$iniFileMatch = str_replace('#', '*', $iniFile);
					if(!fnmatch($iniFileMatch, $localConfigFile))
						continue;
						
					$config = new Zend_Config_Ini("$configPath/$iniFile");
					self::$map[$mapName] = self::mergeConfigItem(self::$map[$mapName], $config->toArray());
				}
				$configDir->close();
			}
		}
		
		if(function_exists('apc_store'))
			apc_store(self::APC_CACHE_MAP, self::$map);
		
		return self::$map[$mapName];
	}
		
	public static function get($paramName)
	{
		self::init();
		if(isset(self::$map[$paramName]))
			return self::$map[$paramName];
		
		throw new Exception("Cannot find [$paramName] in config"); 
	}
	
	public static function hasParam($paramName)
	{
		self::init();
		return isset(self::$map[$paramName]);
	}

	public static function getDB()
	{
		return self::getMap('db');
	}

	/**
	 * @param array $srcConfig
	 * @param array $newConfig
	 * @param bool $valuesOnly
	 * @param bool $overwrite
	 * @return array
	 */
	protected static function mergeConfigItem(array $srcConfig, array $newConfig, $valuesOnly = false, $overwrite = true)
	{
		$returnedConfig = $srcConfig;
		
		if($valuesOnly)
		{
			foreach($srcConfig as $key => $value)
			{
				if(!isset($newConfig[$key])) // nothing to append
					continue;
				elseif(is_array($value))
					$returnedConfig[$key] = self::mergeConfigItem($srcConfig[$key], $newConfig[$key], $valuesOnly, $overwrite);
				elseif($overwrite)
					$returnedConfig[$key] = $newConfig[$key];
				else
					$returnedConfig[$key] = $srcConfig[$key] . ',' . $newConfig[$key];
			}
		}
		else
		{
			foreach($newConfig as $key => $value)
			{
				if(is_numeric($key))
				{
					$returnedConfig[] = $newConfig[$key];
				}
				elseif(!isset($srcConfig[$key]))
				{
					$returnedConfig[$key] = $newConfig[$key];
				}
				elseif(is_array($value))
				{
					if(!isset($srcConfig[$key]))
						$srcConfig[$key] = array();
						
					$returnedConfig[$key] = self::mergeConfigItem($srcConfig[$key], $newConfig[$key], $valuesOnly, $overwrite);
				}
				elseif($overwrite)
				{
					$returnedConfig[$key] = $newConfig[$key];
				}
				else
				{
					$returnedConfig[$key] = $srcConfig[$key] . ',' . $newConfig[$key];
				}
			}
		}
		
		return $returnedConfig;
	}
}

class kConfOld extends kConf
{
	public static function getAll()
	{
		self::$map = array();
		kConf::addConfig();
		kConfLocal::addConfig();
		return self::$map;
	}
}

function compareMaps($oldMap, $newMap, $path = '')
{
	$path .= '/';
	
	if(!is_array($oldMap))
	{
		echo "Old value [$path] is not array\n";
		return;
	}
	
	if(!is_array($newMap))
	{
		echo "New value [$path] is not array\n";
		return;
	}
	
	foreach($oldMap as $key => $oldValue)
	{
		if(!is_array($oldValue) && (is_int($key) || is_numeric($key)))
		{
			$newKey = array_search($oldValue, $newMap);
			if($newKey === false)
			{
				echo "Old array [{$path}] value [$oldValue] is missing\n";
			}
			unset($newMap[$newKey]);
			continue;
		}
		
		if(!isset($newMap[$key]))
		{
			echo "Old key [{$path}{$key}] is missing in the new map\n";
			continue;
		}
		
		$newValue = $newMap[$key];
		
		if(is_array($oldValue))
		{
			compareMaps($oldValue, $newValue, "{$path}{$key}");
		}
		else
		{
			if($oldValue != $newValue)
				echo "Old key [{$path}{$key}] value [$oldValue] is different than new value [$newValue]\n";
		}
		
		//echo "OK [{$path}{$key}]\n";
		unset($newMap[$key]);
	}
	
	foreach($newMap as $key => $value)
	{
		if(is_numeric($key) || is_int($key))
			echo "New array [$path] value [$value] is new addition\n";
		else
			echo "New key [{$path}{$key}] is new addition\n";
	}
}

$oldMap = kConfOld::getAll();
$newMap = kConfNew::getAll();

//echo "___________________________ old ___________________________\n";
//var_dump($oldMap);
//echo "___________________________ old ___________________________\n\n\n\n";
//
//echo "___________________________ new ___________________________\n";
//var_dump($newMap);
//echo "___________________________ new ___________________________\n\n\n\n";

compareMaps($oldMap, $newMap);
compareMaps($oldMap['url_managers_override'], $newMap['url_managers']['override'], '/url_managers/override');
compareMaps(kConfOld::getDB(), kConfNew::getDB(), 'db');

echo "Done\n";