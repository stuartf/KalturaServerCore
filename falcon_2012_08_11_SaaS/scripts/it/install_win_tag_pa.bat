taskKill /F /IM php.exe
taskKill /F /IM pdfcreator.exe
cd c:\opt\kaltura
rmdir app 
mklink /D app eagle_2011_11_22_9
cd c:\opt\kaltura\app\alpha\config
unlink kConfLocal.php 
mklink kConfLocal.php kConfLocal.php.pa
del c:\kalturaInstall
echo > c:\var\log\KGenericBatchMgr.0.log
php C:\opt\kaltura\app\batch\KGenericBatchMgr.class.php php c:\opt\kaltura\app\batch\config\vm\windows\%computername%_config.ini >> C:\var\log\KGenericBatchMgr.0.log
	
