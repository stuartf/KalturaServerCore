<?php

if ($argc < 4)
	die("Usage:\n\tphp syncInvalidSessionsToMemcache <object id> <object type> <object sub type> [<version>]\n");

$SERVER_BY_DC = array(
	0 => 'pa-reports',
	1 => 'ny-admin',
);
	
set_time_limit(0);
ini_set("memory_limit","1024M");

define('ROOT_DIR', realpath(dirname(__FILE__) . '/../../'));
require_once(ROOT_DIR . '/infra/bootstrap_base.php');
require_once(ROOT_DIR . '/infra/KAutoloader.php');

KAutoloader::addClassPath(KAutoloader::buildPath(KALTURA_ROOT_PATH, "vendor", "propel", "*"));
KAutoloader::setClassMapFilePath(ROOT_DIR . '/cache/scripts/' . basename(__FILE__) . '.cache');
KAutoloader::register();

error_reporting(E_ALL);
KalturaLog::setLogger(new KalturaStdoutLogger());

$dbConf = kConf::getDB();
DbManager::setConfig($dbConf);
DbManager::initialize();

$key = new FileSyncKey();
$key->object_id                 = $argv[1];
$key->object_type               = $argv[2];
$key->object_sub_type   = $argv[3];
if ($argc < 5 && $key->object_type == '2')
{
	$uiConf = uiConfPeer::retrieveByPK($key->object_id);
	$reqVersion = $uiConf->getVersion();
}
else
{
	$reqVersion = $argv[4];
}

if (!$reqVersion)
	die("Invalid required version supplied!\n");

$key->version 			= $reqVersion;

function remoteFileExists($dc, $fullPath)
{
	global $SERVER_BY_DC;
	$checkFileCommand = "ssh {$SERVER_BY_DC[$dc]} ls {$fullPath} 2> /dev/nul";
	$output = null;
	exec($checkFileCommand, $output);
	return count($output) == 1 && $output[0] == $fullPath;
}

function getFileSync($key, $dc)
{
        $c = FileSyncPeer::getCriteriaForFileSyncKey($key);
        $c->addAnd(FileSyncPeer::DC, $dc);
        return FileSyncPeer::doSelectOne($c);
}

function getFileSyncPath($key, $dc)
{
        $fileSync = getFileSync($key, $dc);
        if (!$fileSync || !$fileSync->getFileRoot() || !$fileSync->getFilePath())
                return false;
        return rtrim($fileSync->getFileRoot(), '/') . '/' . ltrim($fileSync->getFilePath(), '/');
}

function isFileSyncValid($key, $dc)
{
	$fullPath = getFileSyncPath($key, $dc);
	return remoteFileExists($dc, $fullPath);
}

function execCommand($cmdLine)
{
	print $cmdLine . PHP_EOL;
	exec($cmdLine);
}

function copyRemoteFile($srcDC, $srcPath, $dstDC, $dstPath)
{
        global $SERVER_BY_DC;
	$srcServer = $SERVER_BY_DC[$srcDC];
	$dstServer = $SERVER_BY_DC[$dstDC];
	$dstDirname = dirname($dstPath);
	execCommand("ssh $dstServer mkdir -p $dstDirname");
	execCommand("ssh $dstServer chown apache:apache $dstDirname");

	if ($srcServer != $dstServer)
	{
        	execCommand("scp $srcServer:$srcPath $dstServer:$dstPath");
	}
	else
	{
		execCommand("ssh $srcServer cp $srcPath $dstPath");
	}
}

$validVersion = null;
while ($key->version >= 1 && $validVersion === null)
{
	foreach (array_keys($SERVER_BY_DC) as $dc)
	{
		if (isFileSyncValid($key, $dc))
		{
			$validVersion = $key->version;
			$validDC = $dc;
			break;
		}
	}
	if ($validVersion !== null)
		break;
	$key->version--;
}

if ($validVersion === null)
	die("Could not find a valid version\n");

$key->version = $validVersion;
$otherDC = 1 - $validDC;
if (!isFileSyncValid($key, $otherDC))
{
	// copy file
	$validPath = getFileSyncPath($key, $validDC);
        $invalidPath = getFileSyncPath($key, $otherDC);
	copyRemoteFile($validDC, $validPath, $otherDC, $invalidPath);

	// update file sync
        $validFileSync = getFileSync($key, $validDC);
        $reqFileSync = getFileSync($key, $otherDC);
        $reqFileSync->setReadyAt($validFileSync->getReadyAt(null));
        $reqFileSync->setStatus($validFileSync->getStatus());
        $reqFileSync->setFileSize($validFileSync->getFileSize());
        $reqFileSync->save();
}

if ($reqVersion != $validVersion)
{
	foreach (array_keys($SERVER_BY_DC) as $dc)
	{
		// copy files
		$key->version = $validVersion;
       	 	$sourcePath = getFileSyncPath($key, $dc);
       		$key->version = $reqVersion;
	        $destPath = getFileSyncPath($key, $dc);
		copyRemoteFile($dc, $sourcePath, $dc, $destPath);

		// update file sync
	        $key->version = $validVersion;
        	$validFileSync = getFileSync($key, $dc);
                $key->version = $reqVersion;
		$reqFileSync = getFileSync($key, $dc);
		$reqFileSync->setReadyAt($validFileSync->getReadyAt(null));
		$reqFileSync->setStatus($validFileSync->getStatus());
		$reqFileSync->setFileSize($validFileSync->getFileSize());
		$reqFileSync->save();
	}
}
