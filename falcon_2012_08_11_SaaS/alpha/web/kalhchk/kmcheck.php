<?php

require_once("client/KalturaClient.php");

$config = new KalturaConfiguration ( 1 ); //partner_id
$config->serviceUrl = "http://www.kaltura.com" ; 

$client = new KalturaClient ( $config ) ;

try { 
    $KS = $client->session->start("5678", 'KalturaHealthCheck',KalturaSessionType::ADMIN);
    $client->setKs($KS);
    $media = $client->media->get('_KMCLOGO');
    var_dump($media); 
}
catch(Exception $ex)
{
echo $ex->getMessage();
}
/*
5678
GETKS="http://pa-apache${id}/api_v3/index.php?service=session&action=startWidgetSession&widgetId=_1&nocache"
curl --connect-timeout 2 -s -o - "$GETKS" > $TMPFILE
KS=`cat $TMPFILE | egrep -o '<ks>(.*)</ks>' | sed -e 's/<ks>//;s/<\/ks>//'`
TESTURL="http://pa-apache${id}/api_v3/index.php?service=media&action=get&ks=$KS&entryId=_KMCLOGO&nocache"
 
curl --connect-timeout 2 -s "$TESTURL" | grep -q "KalturaMediaEntry"

*/
