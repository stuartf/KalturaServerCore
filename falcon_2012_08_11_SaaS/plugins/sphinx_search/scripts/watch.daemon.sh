#!/bin/bash
MAILTO="alex.bandel@kaltura.com,eran.etam@kaltura.com"
MAINT=/opt/kaltura/maintenance
SUDO_USER=searchd

BASE_PATH=/opt/kaltura/sphinx
PID_FILE=$BASE_PATH/searchd.pid
CONFIG_FILE=/opt/kaltura/app/configurations/sphinx/kaltura.conf

while /bin/true ; do
#    echo "Sleeping 10 seconds ..."
    sleep 10 
    KP=$(pgrep searchd)
    KF=$(find /usr/local/var/data -type f -name "binlog*" -mmin -3)
    ##if [[ "X$KP" == "X" || "X$KF" == "X" ]] && [[ ! -f $MAINT ]]
    if [[ "X$KP" == "X" && ! -f $MAINT ]]
      then
          if [ -f /opt/kaltura/searchd_is_not_running_email ]
             then 
                 echo "searchd on  `hostname` is not running" | mail -r root@`hostname` -s "searchd service not found on `hostname`" $MAILTO
		 rm -f /opt/kaltura/searchd_is_not_running_email
          fi
	  touch /opt/kaltura/searchd_is_running_email
          echo "`date` searchd on  `hostname` was restarted" 
	  sudo -u $SUDO_USER $BASE_PATH/bin/searchd --config $CONFIG_FILE --stopwait
	  echo "Exit code for stop was $?"
	  sudo -u $SUDO_USER $BASE_PATH/bin/searchd --config $CONFIG_FILE
          sleep 2
	  continue          
    fi
    if [ -f /opt/kaltura/searchd_is_running_email ]
       then
           echo "searchd on  `hostname` is running" | mail -r root@`hostname` -s "searchd service is found on `hostname`" $MAILTO
	   rm -f /opt/kaltura/searchd_is_running_email
    fi
    touch /opt/kaltura/searchd_is_not_running_email
done
