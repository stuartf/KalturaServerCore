<?php

$entryLimitEachLoop = 100;

set_time_limit(0);

ini_set("memory_limit","700M");

chdir(dirname(__FILE__));

define('ROOT_DIR', realpath(dirname(__FILE__) . '/../../../'));
require_once(ROOT_DIR . '/infra/bootstrap_base.php');
require_once(ROOT_DIR . '/infra/KAutoloader.php');

KAutoloader::addClassPath(KAutoloader::buildPath(KALTURA_ROOT_PATH, "vendor", "propel", "*"));
KAutoloader::setClassMapFilePath(kConf::get("cache_root_path") . '/dev/classMap.cache');
KAutoloader::register();

date_default_timezone_set(kConf::get("date_default_timezone")); // America/New_York

error_reporting(E_ALL);
KalturaLog::setLogger(new KalturaStdoutLogger());

DbManager::setConfig(kConf::getDB());
DbManager::initialize();


$con = myDbHelper::getConnection(myDbHelper::DB_HELPER_CONN_PROPEL2);

$c = new Criteria();
$c->setLimit($entryLimitEachLoop);
$c->addAscendingOrderByColumn(adminKuserPeer::ID);
$adminKusers = adminKuserPeer::doSelect($c, $con);


while(count($adminKusers))
{
	foreach($adminKusers as $kuser)
	{
		$kuser->setPasswordUpdatedAt(time());
		$kuser->save();
		$lastId = $kuser->getId();
		KalturaLog::log('Admin kuser id ['.$kuser->getId().'] - password updated at set to ['.$kuser->getPasswordUpdatedAt().']');
	}
	
	adminKuserPeer::clearInstancePool();
	
	$c = new Criteria();
	$c->setLimit($entryLimitEachLoop);
	$c->add(adminKuserPeer::ID, $lastId, Criteria::GREATER_THAN);
	$c->addAscendingOrderByColumn(adminKuserPeer::ID);
	$adminKusers = adminKuserPeer::doSelect($c, $con);
}

KalturaLog::log('Done');
