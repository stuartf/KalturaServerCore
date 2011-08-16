<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_CropDimensions extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaCropDimensions';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->left))
			$this->left = (int)$xml->left;
		if(count($xml->top))
			$this->top = (int)$xml->top;
		if(count($xml->width))
			$this->width = (int)$xml->width;
		if(count($xml->height))
			$this->height = (int)$xml->height;
	}
	/**
	 * Crop left point
	 * 
	 *
	 * @var int
	 */
	public $left = null;

	/**
	 * Crop top point
	 * 
	 *
	 * @var int
	 */
	public $top = null;

	/**
	 * Crop width
	 * 
	 *
	 * @var int
	 */
	public $width = null;

	/**
	 * Crop height
	 * 
	 *
	 * @var int
	 */
	public $height = null;


}

