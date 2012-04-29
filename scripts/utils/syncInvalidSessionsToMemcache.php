<?php

function getKeysMemcache()
{
	if (!kConf::get("query_cache_enabled") || !class_exists('Memcache'))
		return null;
	
	$memcache = new Memcache;	
	$res = @$memcache->connect(kConf::get("global_keys_memcache_host"), kConf::get("global_keys_memcache_port"));
	if (!$res)
		return null;			// failed to connect to memcache

	return $memcache;
}

define('EXPIRY_TIME_MARGIN', 600);
define('PAGE_SIZE', 1000);

set_time_limit(0);
ini_set("memory_limit","1024M");

define('ROOT_DIR', realpath(dirname(__FILE__) . '/../../'));
require_once(ROOT_DIR . '/infra/bootstrap_base.php');
require_once(ROOT_DIR . '/infra/KAutoloader.php');

KAutoloader::addClassPath(KAutoloader::buildPath(KALTURA_ROOT_PATH, "vendor", "propel", "*"));
KAutoloader::setClassMapFilePath('../cache/syncKS2MC_classMap.cache');
KAutoloader::register();

error_reporting(E_ALL);
KalturaLog::setLogger(new KalturaStdoutLogger());

$dbConf = kConf::getDB();
DbManager::setConfig($dbConf);
DbManager::initialize();

myDbHelper::$use_alternative_con = myDbHelper::DB_HELPER_CONN_PROPEL3;

$lastID = null;

$memcache = getKeysMemcache();
if (!$memcache)
	die('Error: failed to connect to global memcache !');

$setCount = 0;

for (;;)
{
	$c = new Criteria();
	if ($lastID !== null)
		$c->add(invalidSessionPeer::ID, $lastID, Criteria::GREATER_THAN);
	$c->addAscendingOrderByColumn(invalidSessionPeer::ID);
	$c->setLimit(PAGE_SIZE);
	$results = invalidSessionPeer::doSelect($c);

	foreach ($results as $result)
	{
		$lastID = $result->getId();

		$ksKey = kSessionBase::INVALID_SESSION_KEY_PREFIX . $result->getKs();
		$ksValidUntil = $result->getKsValidUntil(null);
		$keyExpiry = 0;			// non expiring
		if ($ksValidUntil !== null)
		{
			if ($ksValidUntil + EXPIRY_TIME_MARGIN < time())
				continue;		// already expired
			$keyExpiry = $ksValidUntil + EXPIRY_TIME_MARGIN;
		}
		if ($memcache->set($ksKey, true, 0, $keyExpiry) === false)
			die("Error: failed to set key [{$ksKey}] with expiry [{$keyExpiry}]");
			
		$setCount++;
	}
}

if ($memcache->set(kSessionBase::INVALID_SESSIONS_SYNCED_KEY, true) === false)
	die("Error: failed to set key [" . kSessionBase::INVALID_SESSIONS_SYNCED_KEY . "]");

print("Done!\n{$setCount} keys set\n");
