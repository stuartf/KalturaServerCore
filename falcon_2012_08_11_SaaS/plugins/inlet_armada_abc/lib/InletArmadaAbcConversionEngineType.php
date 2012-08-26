<?php
/**
 * @package api
 * @subpackage enum
 */
class InletArmadaAbcConversionEngineType implements IKalturaPluginEnum, conversionEngineType
{
	const INLET_ARMADA_ABC = 'InletArmadaAbc';
	
	public static function getAdditionalValues()
	{
		return array(
			'INLET_ARMADA_ABC' => self::INLET_ARMADA_ABC
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
