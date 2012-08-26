#!/bin/bash
WHEN=$(date +%Y%m%d)
php /opt/kaltura/app/alpha/batch/updateKuserFromDWH.php >> /var/log/updateKuserFromDWH-${WHEN}.log 2>&1