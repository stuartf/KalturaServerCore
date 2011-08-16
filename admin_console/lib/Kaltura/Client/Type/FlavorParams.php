<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_FlavorParams extends Kaltura_Client_Type_AssetParams
{
	public function getKalturaObjectType()
	{
		return 'KalturaFlavorParams';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->videoCodec = (string)$xml->videoCodec;
		if(count($xml->videoBitrate))
			$this->videoBitrate = (int)$xml->videoBitrate;
		$this->audioCodec = (string)$xml->audioCodec;
		if(count($xml->audioBitrate))
			$this->audioBitrate = (int)$xml->audioBitrate;
		if(count($xml->audioChannels))
			$this->audioChannels = (int)$xml->audioChannels;
		if(count($xml->audioSampleRate))
			$this->audioSampleRate = (int)$xml->audioSampleRate;
		if(count($xml->width))
			$this->width = (int)$xml->width;
		if(count($xml->height))
			$this->height = (int)$xml->height;
		if(count($xml->frameRate))
			$this->frameRate = (int)$xml->frameRate;
		if(count($xml->gopSize))
			$this->gopSize = (int)$xml->gopSize;
		$this->conversionEngines = (string)$xml->conversionEngines;
		$this->conversionEnginesExtraParams = (string)$xml->conversionEnginesExtraParams;
		if(!empty($xml->twoPass))
			$this->twoPass = true;
		if(count($xml->deinterlice))
			$this->deinterlice = (int)$xml->deinterlice;
		if(count($xml->rotate))
			$this->rotate = (int)$xml->rotate;
		$this->operators = (string)$xml->operators;
		if(count($xml->engineVersion))
			$this->engineVersion = (int)$xml->engineVersion;
	}
	/**
	 * The video codec of the Flavor Params
	 * 
	 *
	 * @var Kaltura_Client_Enum_VideoCodec
	 */
	public $videoCodec = null;

	/**
	 * The video bitrate (in KBits) of the Flavor Params
	 * 
	 *
	 * @var int
	 */
	public $videoBitrate = null;

	/**
	 * The audio codec of the Flavor Params
	 * 
	 *
	 * @var Kaltura_Client_Enum_AudioCodec
	 */
	public $audioCodec = null;

	/**
	 * The audio bitrate (in KBits) of the Flavor Params
	 * 
	 *
	 * @var int
	 */
	public $audioBitrate = null;

	/**
	 * The number of audio channels for "downmixing"
	 * 
	 *
	 * @var int
	 */
	public $audioChannels = null;

	/**
	 * The audio sample rate of the Flavor Params
	 * 
	 *
	 * @var int
	 */
	public $audioSampleRate = null;

	/**
	 * The desired width of the Flavor Params
	 * 
	 *
	 * @var int
	 */
	public $width = null;

	/**
	 * The desired height of the Flavor Params
	 * 
	 *
	 * @var int
	 */
	public $height = null;

	/**
	 * The frame rate of the Flavor Params
	 * 
	 *
	 * @var int
	 */
	public $frameRate = null;

	/**
	 * The gop size of the Flavor Params
	 * 
	 *
	 * @var int
	 */
	public $gopSize = null;

	/**
	 * The list of conversion engines (comma separated)
	 * 
	 *
	 * @var string
	 */
	public $conversionEngines = null;

	/**
	 * The list of conversion engines extra params (separated with "|")
	 * 
	 *
	 * @var string
	 */
	public $conversionEnginesExtraParams = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	public $twoPass = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $deinterlice = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $rotate = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $operators = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $engineVersion = null;


}

