#!/bin/bash
#WGET_RC=1
#while [ $WGET_RC -ne 0 ]; do
PARTNAME=$1
wget "ftp://ftp.kaltura.com/akamai_*.esw3c_S."$PARTNAME"0000-2400-*.gz"
#	WGET_RC=$?
#done
