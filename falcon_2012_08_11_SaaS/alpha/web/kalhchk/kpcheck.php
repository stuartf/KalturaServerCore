<?php

require_once("client/KalturaClient.php");

$config = new KalturaConfiguration ( 99 ); //partner_id
$config->serviceUrl = "http://www.kaltura.com" ; 

$client = new KalturaClient ( $config ) ;

try { 
    $KS = $client->session->start("37e368cfa63e37eaad96c0fd02e0bd8d", 'KalturaHealthCheck',KalturaSessionType::ADMIN);
    $client->setKs($KS);
    $myplaylist = $client->playlist->execute('q0rb2v97fk');
    var_dump($myplaylist); 
}
catch(Exception $ex)
{
echo $ex->getMessage();
}
/*
5678
GETKS="http://pa-apache${id}/api_v3/index.php?service=session&action=startWidgetSession&widgetId=_99&nocache"
curl -s -o - "$GETKS" > $TMPFILE
KS=`cat $TMPFILE | egrep -o '<ks>(.*)</ks>' | sed -e 's/<ks>//;s/<\/ks>//'`
#http://pa-www/index.php/partnerservices2/executeplaylist?uid=&partner_id=99&subp_id=9900&format=8&ks=$KS=&playlist_id=q0rb2v97fk"
TESTURL="http://pa-apache${id}/index.php/partnerservices2/executeplaylist?uid=&partner_id=99&subp_id=9900&format=8&ks=$KS&playlist_id=q0rb2v97fk&nocache"
 
curl -s "$TESTURL" | grep -q "item"

*/


