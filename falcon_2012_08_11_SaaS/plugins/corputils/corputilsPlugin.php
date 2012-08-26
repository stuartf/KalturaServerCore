<?php
class CorputilsPlugin extends KalturaPlugin implements IKalturaPermissions, IKalturaServices
{
	const PLUGIN_NAME = 'corputils';
	
	public static function getPluginName()
	{
		return self::PLUGIN_NAME;
	}
	
	public static function isAllowedPartner($partnerId)
	{
		if($partnerId == -10)
			return true;
		
		return false;
	}
	
	/**
	 * @return array<string,string> in the form array[serviceName] = serviceClass
	 */
	public static function getServicesMap()
	{
		$map = array(
			'corputils' => 'CorputilsService',
		);
		return $map;
	}
	
	/**
	 * @return string - the path to services.ct
	 */
	public static function getServiceConfig()
	{
		return realpath(dirname(__FILE__).'/config/corputils.ct');
	}
	
	/*
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
//		$config = new Zend_Config_Ini(dirname(__FILE__).'/../config/database.ini');
//		return $config->toArray();
	}
	*/
	
}
?>
