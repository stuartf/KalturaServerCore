<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_Type_ThumbParamsOutputBaseFilter extends Kaltura_Client_Type_ThumbParamsFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaThumbParamsOutputBaseFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->thumbParamsIdEqual))
			$this->thumbParamsIdEqual = (int)$xml->thumbParamsIdEqual;
		$this->thumbParamsVersionEqual = (string)$xml->thumbParamsVersionEqual;
		$this->thumbAssetIdEqual = (string)$xml->thumbAssetIdEqual;
		$this->thumbAssetVersionEqual = (string)$xml->thumbAssetVersionEqual;
	}
	/**
	 * 
	 *
	 * @var int
	 */
	public $thumbParamsIdEqual = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $thumbParamsVersionEqual = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $thumbAssetIdEqual = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $thumbAssetVersionEqual = null;


}

