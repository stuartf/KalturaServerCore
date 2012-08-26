<?php

$partnerId = null;
if ( $argc == 2)
{
	$partnerId = $argv[1];	
}
if (is_null($partnerId))
{
	die ( 'usage: php ' . $_SERVER ['SCRIPT_NAME'] . ' [partner id]' . PHP_EOL );
}

error_reporting(E_ALL);
require_once(dirname(__FILE__).'/../../../scripts/bootstrap.php');

KAutoloader::addClassPath(KAutoloader::buildPath(KALTURA_ROOT_PATH, "vendor", "propel", "*"));
KAutoloader::addClassPath(KAutoloader::buildPath(KALTURA_ROOT_PATH, "plugins", "abc_specific", "*"));
KAutoloader::setClassMapFilePath(KALTURA_ROOT_PATH.'/cache/scripts/classMap'.uniqid().'.cache');
KAutoloader::register();

$partner = PartnerPeer::retrieveByPK($partnerId);
if (!$partner) {
    die('cannot find partner with id ['.$partnerId.']');
}
PermissionPeer::enablePlugin(AbcSpecificPlugin::getPluginName(), $partnerId);

die('Plugin enabled'.PHP_EOL);
