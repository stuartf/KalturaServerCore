#!/bin/bash
SERVER=$1
MAILTO="alex.bandel@kaltura.com"
KP=$(pgrep -f "populateFromLog.php $SERVER")
MAINT=/opt/kaltura/maintenance
if [[ "X$KP" == "X" && ! -f $MAINT ]]
      then
          echo "populateFromLog.php `hostname` was restarted" | mail -s "populateFromLog.php script not found on `hostname`" $MAILTO
	  cd /opt/kaltura/app/plugins/sphinx_search/scripts
	  php populateFromLog.php ${SERVER} >> /var/log/kaltura_sphinx_populate.log.`cat ${SERVER} | grep sphinxServer | awk -F"'" '{ print $2}'` 2>&1 &
      fi

