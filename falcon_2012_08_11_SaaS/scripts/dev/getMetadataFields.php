<?php

if($argc < 2)
{
	echo "Arguments missing.\n\n";
	echo "Usage: php getMetadataFields.php {metadata profile id} [{min version}] [{max version}] [{data folder path}]\n";
	exit;
}
$metadataProfileId = $argv[1];
$minMetadataProfileVersion = null;
$maxMetadataProfileVersion = null;
$folderPath = null;

if($argc > 2)
	$minMetadataProfileVersion = $argv[2];
	
if($argc > 3)
	$maxMetadataProfileVersion = $argv[3];
	
if($argc > 4)
	$folderPath = $argv[4];
	


set_time_limit(0);

ini_set("memory_limit","700M");

chdir(dirname(__FILE__));

define('ROOT_DIR', realpath(dirname(__FILE__) . '/../../'));
require_once(ROOT_DIR . '/infra/bootstrap_base.php');
require_once(ROOT_DIR . '/infra/KAutoloader.php');

KAutoloader::addClassPath(KAutoloader::buildPath(KALTURA_ROOT_PATH, "vendor", "propel", "*"));
KAutoloader::addClassPath(KAutoloader::buildPath(KALTURA_ROOT_PATH, "plugins", "metadata", "*"));
KAutoloader::setClassMapFilePath(kConf::get("cache_root_path") . '/dev/classMap.cache');
KAutoloader::register();

error_reporting(E_ALL);

KalturaLog::setLogger(new KalturaStdoutLogger());

$dbConf = kConf::getDB();
DbManager::setConfig($dbConf);
DbManager::initialize();

$c = new Criteria();
$c->add(MetadataPeer::METADATA_PROFILE_ID, $metadataProfileId);
if($minMetadataProfileVersion)
	$c->add(MetadataPeer::METADATA_PROFILE_VERSION, $minMetadataProfileVersion, Criteria::GREATER_EQUAL);
if($maxMetadataProfileVersion)
	$c->add(MetadataPeer::METADATA_PROFILE_VERSION, $maxMetadataProfileVersion, Criteria::LESS_EQUAL);

MetadataPeer::setUseCriteriaFilter(false);
$metadatas = MetadataPeer::doSelect($c);
KalturaLog::log("Found [" . count($metadatas) . "] metadata objects");

function parseXml(DOMNode $node, $path = '')
{
	if($node->nodeType == XML_TEXT_NODE || !$node->childNodes || !$node->childNodes->length)
	{
		$textContent = $node->textContent;
		if(!strlen(trim($textContent)))
			return null;
			
		return "$path:$textContent";
	}
	
	$nodeName = $node->nodeName;
	$path .= "/$nodeName";
	
	$childrenParsed = array();
	foreach($node->childNodes as $childNode)
	{
		if($childNode->nodeType == XML_COMMENT_NODE)
			continue;
			
		$childParsed = parseXml($childNode, $path);
		if($childParsed)
			$childrenParsed[] = $childParsed;
	}
	if(!count($childrenParsed))
		return null;
			
	return implode("\n", $childrenParsed);
}

foreach($metadatas as $metadata)
{
	KalturaLog::log("Metadata id [" . $metadata->getId() . "] object id [" . $metadata->getObjectId() . "]");
	$syncKey = $metadata->getSyncKey(Metadata::FILE_SYNC_METADATA_DATA);
	$syncPath = kFileSyncUtils::getLocalFilePathForKey($syncKey);
	
	if(!$syncPath || !file_exists($syncPath))
	{
		KalturaLog::log("Metadata file [$syncPath] does not exist");
		continue;
	}
	
	$xml = new DOMDocument();
	try
	{
		$xml->load($syncPath);
	}
	catch(Exception $e)
	{
		KalturaLog::log("Metadata file not loaded: " . $e->getMessage());
		continue;
	}
	
	$str = parseXml($xml->firstChild);
	if($folderPath)
	{
		file_put_contents("$folderPath/" . $metadata->getObjectId() . '.' . $metadata->getMetadataProfileVersion() . '.dat', $str);
	}
	else 
	{
		KalturaLog::log("Metadata data:\n$str");
	}
}
