<?
set_time_limit(0);
require_once(dirname(__FILE__).'/../../alpha/config/sfrootdir.php');

require_once("../bootstrap.php");

KalturaLog::setContext("serveDirectContent");

//RewriteRule ^/content/(.*)/entry/data/(.*)$ /api_v3/serveDirectContent.php [L]
//RewriteRule ^/p/[0-9]+/content/(.*)$  /api_v3/serveDirectContent.php [L]
//RewriteRule ^/p/[0-9]+/sp/[0-9]+/content/(.*)$ /api_v3/serveDirectContent.php [L]

$scriptUrl = $_SERVER['SCRIPT_URL'];

// we expect to get here only via a rewrite rule
if (strpos($scriptUrl, "serveDirectContent.php"))
	die;

$basename = basename($scriptUrl);

// parse entryId either as an old int id 123_flavorId or new id 0_123_flavorId 
list($entryId) = explode("_", substr($basename,2));
$entryId =  substr($basename,0,2).$entryId;

KalturaLog::log("url: [$scriptUrl] entryId: [$entryId]");
$entry = entryPeer::retrieveByPk($entryId);
$partners = array(295942,325802,325822,336291,336301,336311,372651,373051,373061,395871,395891,395911,395921,396031,396041,396061,396071,396081,486891,870161,870171,870181,870191,870211,444991,470781,477471,506041,525511,525791,585831,595571,762871,762901,762921,764021,764031,764041,794862,86452,782152,779962,782601,859791,506041);
if ($entry && in_array($entry->getPartnerId(), $partners))
	KExternalErrors::dieError(KExternalErrors::DELIVERY_METHOD_NOT_ALLOWED);

$pos = strpos($scriptUrl, "/content");
$fullPath = realpath(myContentStorage::getFSContentRootPath().substr($scriptUrl, $pos));
$mimeType = null;//mime_content_type($fullPath);

KalturaLog::log("dump: [$fullPath] mimeType: [mimeType]");

kFile::dumpFile($fullPath);//, $mimeType);
