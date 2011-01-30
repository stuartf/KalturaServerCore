<?php

class SegmenterPlugin extends KalturaPlugin implements IKalturaObjectLoader, IKalturaEnumerator
{
	const PLUGIN_NAME = 'segmenter';
	
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
		if($baseClass == 'KOperationEngine' && $enumValue == KalturaConversionEngineType::SEGMENTER)
		{
			if(!isset($constructorArgs['params']) || !isset($constructorArgs['outFilePath']))
				return null;
				
			$params = $constructorArgs['params'];
			return new KOperationEngineSegmenter($params->segmenterCmd, $constructorArgs['outFilePath']);
		}
	
		if($baseClass == 'KDLOperatorBase' && $enumValue == SegmenterConversionEngineType::get()->apiValue(SegmenterConversionEngineType::SEGMENTER))
		{
			return new KDLOperatorSegmenter($enumValue);
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
		if($baseClass == 'KOperationEngine' && $enumValue == SegmenterConversionEngineType::get()->apiValue(SegmenterConversionEngineType::SEGMENTER))
			return 'KOperationEngineSegmenter';
	
		if($baseClass == 'KDLOperatorBase' && $enumValue == SegmenterConversionEngineType::get()->coreValue(SegmenterConversionEngineType::Segmenter))
			return 'KDLOperatorSegmenter';
		
		return null;
	}
	
	/**
	 * @return array<string> list of enum classes names that extend the base enum name
	 */
	public static function getEnums($baseEnumName)
	{
		if($baseEnumName == 'conversionEngineType')
			return array('SegmenterConversionEngineType');
			
		return array();
	}
}
