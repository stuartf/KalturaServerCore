<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_ThumbParamsOutput extends Kaltura_Client_Type_ThumbParams
{
	public function getKalturaObjectType()
	{
		return 'KalturaThumbParamsOutput';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->thumbParamsId))
			$this->thumbParamsId = (int)$xml->thumbParamsId;
		$this->thumbParamsVersion = (string)$xml->thumbParamsVersion;
		$this->thumbAssetId = (string)$xml->thumbAssetId;
		$this->thumbAssetVersion = (string)$xml->thumbAssetVersion;
	}
	/**
	 * 
	 *
	 * @var int
	 */
	public $thumbParamsId = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $thumbParamsVersion = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $thumbAssetId = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $thumbAssetVersion = null;


}

