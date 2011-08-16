<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_FlavorAsset extends Kaltura_Client_Type_Asset
{
	public function getKalturaObjectType()
	{
		return 'KalturaFlavorAsset';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->flavorParamsId))
			$this->flavorParamsId = (int)$xml->flavorParamsId;
		if(count($xml->width))
			$this->width = (int)$xml->width;
		if(count($xml->height))
			$this->height = (int)$xml->height;
		if(count($xml->bitrate))
			$this->bitrate = (int)$xml->bitrate;
		if(count($xml->frameRate))
			$this->frameRate = (int)$xml->frameRate;
		if(!empty($xml->isOriginal))
			$this->isOriginal = true;
		if(!empty($xml->isWeb))
			$this->isWeb = true;
		$this->containerFormat = (string)$xml->containerFormat;
		$this->videoCodecId = (string)$xml->videoCodecId;
	}
	/**
	 * The Flavor Params used to create this Flavor Asset
	 * 
	 *
	 * @var int
	 * @insertonly
	 */
	public $flavorParamsId = null;

	/**
	 * The width of the Flavor Asset 
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $width = null;

	/**
	 * The height of the Flavor Asset
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $height = null;

	/**
	 * The overall bitrate (in KBits) of the Flavor Asset 
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $bitrate = null;

	/**
	 * The frame rate (in FPS) of the Flavor Asset
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $frameRate = null;

	/**
	 * True if this Flavor Asset is the original source
	 * 
	 *
	 * @var bool
	 * @readonly
	 */
	public $isOriginal = null;

	/**
	 * True if this Flavor Asset is playable in KDP
	 * 
	 *
	 * @var bool
	 * @readonly
	 */
	public $isWeb = null;

	/**
	 * The container format
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $containerFormat = null;

	/**
	 * The video codec
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $videoCodecId = null;


}

