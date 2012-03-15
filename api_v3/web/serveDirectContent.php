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
if ($entry && $entry->getPartnerId() == 396071)
	KExternalErrors::dieError(KExternalErrors::DELIVERY_METHOD_NOT_ALLOWED);

$pos = strpos($scriptUrl, "/content");
$fullPath = realpath(myContentStorage::getFSContentRootPath().substr($scriptUrl, $pos));
$mimeType = mime_content_type($fullPath);

KalturaLog::log("dump: [$fullPath] mimeType: [mimeType]");

kFile::dumpFile($fullPath, $mimeType);
