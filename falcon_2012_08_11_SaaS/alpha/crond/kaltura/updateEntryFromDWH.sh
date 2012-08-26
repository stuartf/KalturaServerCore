#!/bin/bash
WHEN=$(date +%Y%m%d)
php /opt/kaltura/app/alpha/batch/updateEntryFromDWH.php >> /var/log/updateEntryFromDWH-${WHEN}.log 2>&1