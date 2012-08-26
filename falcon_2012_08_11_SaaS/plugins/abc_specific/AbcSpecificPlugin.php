<?php
/**
 * @package plugins.abcSpecific
 */
class AbcSpecificPlugin extends KalturaPlugin implements IKalturaPermissions, IKalturaEventConsumers
{
	const PLUGIN_NAME = 'abcSpecific';
	const ABC_SPECIFIC_EVENTS_CONSUMER = 'kAbcSpecificFlowManager';
	
	public static function getPluginName()
	{
		return self::PLUGIN_NAME;
	}
	
	public static function isAllowedPartner($partnerId)
	{
		$partner = PartnerPeer::retrieveByPK($partnerId);
		return $partner->getPluginEnabled(self::PLUGIN_NAME);		
	}
					
	/**
	 * @return array
	 */
	public static function getEventConsumers()
	{
		return array(
			self::ABC_SPECIFIC_EVENTS_CONSUMER,
		);
	}
}
