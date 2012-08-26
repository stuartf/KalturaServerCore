<?php

// ----- change these --------
$partnerId = null;
$maxLognAttempts = null;
$loginBlockPeriod = null; // in seconds
$prevPassToKeep = null;
$passReplaceFreq = null;
// ---------------------------


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

$partner = PartnerPeer::retrieveByPK($partnerId);
if (!$partner) {
	throw Exception ('Partner not found!');
}

$partner->setMaxLoginAttempts($maxLognAttempts);
$partner->setLoginBlockPeriod($loginBlockPeriod);
$partner->setNumPrevPassToKeep($prevPassToKeep);
$partner->setPassReplaceFreq($passReplaceFreq);
$partner->save();

KalturaLog::log('Done');
