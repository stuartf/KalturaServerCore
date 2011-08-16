<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_ConversionAttribute extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaConversionAttribute';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->flavorParamsId))
			$this->flavorParamsId = (int)$xml->flavorParamsId;
		$this->name = (string)$xml->name;
		$this->value = (string)$xml->value;
	}
	/**
	 * The id of the flavor params, set to null for source flavor
	 * 
	 *
	 * @var int
	 */
	public $flavorParamsId = null;

	/**
	 * Attribute name  
	 * 
	 *
	 * @var string
	 */
	public $name = null;

	/**
	 * Attribute value  
	 * 
	 *
	 * @var string
	 */
	public $value = null;


}

