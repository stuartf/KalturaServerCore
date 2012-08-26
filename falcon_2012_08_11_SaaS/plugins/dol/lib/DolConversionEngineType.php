<?php
/**
 * @package plugins.dol
 * @subpackage lib
 */
class DolConversionEngineType implements IKalturaPluginEnum, conversionEngineType
{
	const DOL = 'Dol';
	
	public static function getAdditionalValues()
	{
		return array(
			'DOL' => self::DOL
		);
	}
	
	/**
	 * @return array
	 */
	public static function getAdditionalDescriptions()
	{
		return array();
	}
}
