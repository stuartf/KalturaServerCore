<?php
/**
 * @package plugins.document
 * @subpackage api.objects
 */
class KalturaSwfFlavorParamsOutput extends KalturaFlavorParamsOutput 
{
	public function toObject($object = null, $skip = array())
	{
		if(is_null($object))
			$object = new SwfFlavorParamsOutput();
		
		parent::toObject($object, $skip);
		$object->setType(DocumentPlugin::getAssetTypeCoreValue(DocumentAssetType::SWF));
	}
	
	/**
	 * @var int
	 */
	public $flashVersion;
	
	/**
	 * @var bool
	 */
	public $poly2Bitmap;
	
	private static $map_between_objects = array
	(
	'flashVersion',
	'poly2Bitmap',
	);
	
	public function getMapBetweenObjects()
	{
		return array_merge(parent::getMapBetweenObjects(), self::$map_between_objects);
	}
}