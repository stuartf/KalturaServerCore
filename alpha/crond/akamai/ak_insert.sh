#!/bin/bash
PARTNAME=$1
echo "zcatting..."
FILENAME=$PARTNAME"0000-2400"
zcat akamai_*.esw3c_S.$FILENAME-* | php /opt/kaltura/app/alpha/scripts/billing_summary_akamai.php  >ak_res
echo "finished zcat"
php /opt/kaltura/app/alpha/scripts/billing_summary_insert.php ak $1 ak_res >ak_res.sql
mysql -hpa-db kaltura -uroot -proot < ak_res.sql

rm -f ak_res
rm -f ak_res.sql
