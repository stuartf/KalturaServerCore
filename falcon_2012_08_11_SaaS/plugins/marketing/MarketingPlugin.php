<?php
/**
 * @package plugins.marketing
 */
class MarketingPlugin extends KalturaPlugin implements IKalturaServices, IKalturaEventConsumers
{
	const PLUGIN_NAME = 'marketing';
	const MARKETING_MANAGER = 'kMarketingManager';
	
	public static function getPluginName()
	{
		return self::PLUGIN_NAME;
	}
	
	/**
	 * @return array<string,string> in the form array[serviceName] = serviceClass
	 */
	public static function getServicesMap()
	{
		$map = array(
			//'partnerInfo' => 'PartnerInfoService',
		);
		return $map;
	}
	
	/**
	 * @return string - the path to services.ct
	 */
	public static function getServiceConfig()
	{
	}

	/**
	 * @return array
	 */
	public static function getEventConsumers()
	{
		return array(
			self::MARKETING_MANAGER,
		);
	}
}
