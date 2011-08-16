<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_FlavorParamsOutput extends Kaltura_Client_Type_FlavorParams
{
	public function getKalturaObjectType()
	{
		return 'KalturaFlavorParamsOutput';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->flavorParamsId))
			$this->flavorParamsId = (int)$xml->flavorParamsId;
		$this->commandLinesStr = (string)$xml->commandLinesStr;
		$this->flavorParamsVersion = (string)$xml->flavorParamsVersion;
		$this->flavorAssetId = (string)$xml->flavorAssetId;
		$this->flavorAssetVersion = (string)$xml->flavorAssetVersion;
		if(count($xml->readyBehavior))
			$this->readyBehavior = (int)$xml->readyBehavior;
	}
	/**
	 * 
	 *
	 * @var int
	 */
	public $flavorParamsId = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $commandLinesStr = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $flavorParamsVersion = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $flavorAssetId = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $flavorAssetVersion = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $readyBehavior = null;


}

