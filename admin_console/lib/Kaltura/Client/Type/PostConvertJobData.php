<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_PostConvertJobData extends Kaltura_Client_Type_ConvartableJobData
{
	public function getKalturaObjectType()
	{
		return 'KalturaPostConvertJobData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->flavorAssetId = (string)$xml->flavorAssetId;
		if(!empty($xml->createThumb))
			$this->createThumb = true;
		$this->thumbPath = (string)$xml->thumbPath;
		if(count($xml->thumbOffset))
			$this->thumbOffset = (int)$xml->thumbOffset;
		if(count($xml->thumbHeight))
			$this->thumbHeight = (int)$xml->thumbHeight;
		if(count($xml->thumbBitrate))
			$this->thumbBitrate = (int)$xml->thumbBitrate;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $flavorAssetId = null;

	/**
	 * Indicates if a thumbnail should be created
	 * 
	 *
	 * @var bool
	 */
	public $createThumb = null;

	/**
	 * The path of the created thumbnail
	 * 
	 *
	 * @var string
	 */
	public $thumbPath = null;

	/**
	 * The position of the thumbnail in the media file
	 * 
	 *
	 * @var int
	 */
	public $thumbOffset = null;

	/**
	 * The height of the movie, will be used to comapare if this thumbnail is the best we can have
	 * 
	 *
	 * @var int
	 */
	public $thumbHeight = null;

	/**
	 * The bit rate of the movie, will be used to comapare if this thumbnail is the best we can have
	 * 
	 *
	 * @var int
	 */
	public $thumbBitrate = null;


}

