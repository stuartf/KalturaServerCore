<?php
/**
 * @package api
 * @subpackage enum
 */
class SegmenterConversionEngineType extends KalturaConversionEngineType

{
	const SEGMENTER = 'Segmenter';
	
	/**
	 * @var SegmenterConversionEngineType
	 */
	protected static $instance;

	/**
	 * @return SegmenterConversionEngineType
	 */
	public static function get()
	{
		if(!self::$instance)
			self::$instance = new SegmenterConversionEngineType();
			
		return self::$instance;
	}
	
	public static function getAdditionalValues()
	{
		return array(
			'SEGMENTER' => self::SEGMENTER
		);
	}
	
	public function getPluginName()
	{
		return SegmenterPlugin::getPluginName();
	}
}
