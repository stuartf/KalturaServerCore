<?php
/**
 * @package plugins.tvComDistribution
 * @subpackage lib
 */
class TVComDistributionProviderType implements IKalturaPluginEnum, DistributionProviderType
{
	const TVCOM = 'TVCOM';
	
	/**
	 * @return SyndicationDistributionProviderType
	 */
	public static function get()
	{
		if(!self::$instance)
			self::$instance = new TVComDistributionProviderType();
			
		return self::$instance;
	}
		
	public static function getAdditionalValues()
	{
		return array(
			'TVCOM' => self::TVCOM,
		);
	}
	
	public function getPluginName()
	{
		return TVComDistributionPlugin::getPluginName();
	}	
}
