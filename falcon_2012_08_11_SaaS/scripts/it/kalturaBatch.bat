echo on
IF EXIST c:\kalturaInstall (
	c:\opt\kaltura\app\scripts\it\install_win_tag_ny.bat
	) ELSE (
	echo NO NEED  TO INSTALL TAG
	)
echo > c:\var\log\KGenericBatchMgr.0.log
cd C:\opt\kaltura\app\batch
php KGenericBatchMgr.class.php php c:\opt\kaltura\app\batch\config\vm\windows\%computername%_config.ini >> C:\var\log\KGenericBatchMgr.0.log
	
