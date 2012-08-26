<?php
/**
*@package plugins.inletArmadaAbc
*/
class InletArmadaAbcPlugin extends KalturaPlugin implements IKalturaObjectLoader, IKalturaEnumerator
{
	const PLUGIN_NAME = 'inletArmadaAbc';
	
	public static function getPluginName()
	{
		return self::PLUGIN_NAME;
	}
	
	/**
	 * @param string $baseClass
	 * @param string $enumValue
	 * @param array $constructorArgs
	 * @return object
	 */
	public static function loadObject($baseClass, $enumValue, array $constructorArgs = null)
	{
KalturaLog::log("1-baseClass:$baseClass,enumValue:$enumValue,\n");
		if($baseClass == 'KOperationEngine' && $enumValue == KalturaConversionEngineType::INLET_ARMADA_ABC)
		{
			if(!isset($constructorArgs['params']) || !isset($constructorArgs['outFilePath']))
				return null;
				
			return new KOperationEngineInletArmadaAbc("", $constructorArgs['outFilePath']);
		}

		if($baseClass == 'KDLOperatorBase' && $enumValue == self::getApiValue(InletArmadaAbcConversionEngineType::INLET_ARMADA_ABC))
		{
			return new KDLOperatorInletArmada($enumValue);
		}
		
		return null;
	}

	/**
	 * @param string $baseClass
	 * @param string $enumValue
	 * @return string
	 */
	public static function getObjectClass($baseClass, $enumValue)
	{
		if($baseClass == 'KOperationEngine' && $enumValue == self::getApiValue(InletArmadaAbcConversionEngineType::INLET_ARMADA_ABC))
			return 'KOperationEngineInletArmadaAbc';
	
		if($baseClass == 'KDLOperatorBase' && $enumValue == self::getConversionEngineCoreValue(InletArmadaAbcConversionEngineType::INLET_ARMADA_ABC))
			return 'KDLOperatorInletArmadaAbc';
		
		return null;
	}
	
	/**
	 * @return array<string> list of enum classes names that extend the base enum name
	 */
	public static function getEnums($baseEnumName = null)
	{
		if(is_null($baseEnumName))
			return array('InletArmadaAbcConversionEngineType');
	
		if($baseEnumName == 'conversionEngineType')
			return array('InletArmadaAbcConversionEngineType');
			
		return array();
	}
	
	/**
	 * @return int id of dynamic enum in the DB.
	 */
	public static function getConversionEngineCoreValue($valueName)
	{
		$value = self::getPluginName() . IKalturaEnumerator::PLUGIN_VALUE_DELIMITER . $valueName;
		return kPluginableEnumsManager::apiToCore('conversionEngineType', $value);
	}
	
	/**
	 * @return string external API value of dynamic enum.
	 */
	public static function getApiValue($valueName)
	{
		return self::getPluginName() . IKalturaEnumerator::PLUGIN_VALUE_DELIMITER . $valueName;
	}
}
