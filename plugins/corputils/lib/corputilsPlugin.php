<?php
class corputilsPlugin implements IKalturaPlugin
{
	public static function getServicesMap()
	{
		//$extraServicePath = realpath(dirname(__FILE__).'/../services/corputilsExtServices.php');
		//return array('_corputils' => $extraServicePath);
		return array('_corputils' => '_corputilsService');
	}
	
	public static function getServiceConfig()
	{
		return realpath(dirname(__FILE__).'/../config/corputils.ct');
	}

	public static function getDatabaseConfig()
	{
		return new Zend_Config_Ini(dirname(__FILE__).'/../config/database.ini');
	}
	
	public static function isAllowedPartner($partnerId)
	{
		if($partnerId == -10)
			return true;
		
		return false;
	}
}
?>
