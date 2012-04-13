#!/bin/bash

WHEN=$(date -d "yesterday" +%Y-%m-%d)

#php /opt/kaltura/app/scripts/findEntriesSizes.php $WHEN >> /var/log/`hostname`-findEntriesSizes.log
php /opt/kaltura/app/alpha/batch/batchPartnerUsage.php >> /var/log/`hostname`-BatchPartnerUsage_upgradeProcess.log 2>&1
