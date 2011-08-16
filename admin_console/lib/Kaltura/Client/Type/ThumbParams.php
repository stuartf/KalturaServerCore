<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_ThumbParams extends Kaltura_Client_Type_AssetParams
{
	public function getKalturaObjectType()
	{
		return 'KalturaThumbParams';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->cropType))
			$this->cropType = (int)$xml->cropType;
		if(count($xml->quality))
			$this->quality = (int)$xml->quality;
		if(count($xml->cropX))
			$this->cropX = (int)$xml->cropX;
		if(count($xml->cropY))
			$this->cropY = (int)$xml->cropY;
		if(count($xml->cropWidth))
			$this->cropWidth = (int)$xml->cropWidth;
		if(count($xml->cropHeight))
			$this->cropHeight = (int)$xml->cropHeight;
		if(count($xml->videoOffset))
			$this->videoOffset = (float)$xml->videoOffset;
		if(count($xml->width))
			$this->width = (int)$xml->width;
		if(count($xml->height))
			$this->height = (int)$xml->height;
		if(count($xml->scaleWidth))
			$this->scaleWidth = (float)$xml->scaleWidth;
		if(count($xml->scaleHeight))
			$this->scaleHeight = (float)$xml->scaleHeight;
		$this->backgroundColor = (string)$xml->backgroundColor;
		if(count($xml->sourceParamsId))
			$this->sourceParamsId = (int)$xml->sourceParamsId;
	}
	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_ThumbCropType
	 */
	public $cropType = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $quality = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $cropX = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $cropY = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $cropWidth = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $cropHeight = null;

	/**
	 * 
	 *
	 * @var float
	 */
	public $videoOffset = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $width = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $height = null;

	/**
	 * 
	 *
	 * @var float
	 */
	public $scaleWidth = null;

	/**
	 * 
	 *
	 * @var float
	 */
	public $scaleHeight = null;

	/**
	 * Hexadecimal value
	 *
	 * @var string
	 */
	public $backgroundColor = null;

	/**
	 * Id of the flavor params or the thumbnail params to be used as source for the thumbnail creation
	 *
	 * @var int
	 */
	public $sourceParamsId = null;


}

