<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_Type_AssetParamsBaseFilter extends Kaltura_Client_Type_Filter
{
	public function getKalturaObjectType()
	{
		return 'KalturaAssetParamsBaseFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->systemNameEqual = (string)$xml->systemNameEqual;
		$this->systemNameIn = (string)$xml->systemNameIn;
		if(count($xml->isSystemDefaultEqual))
			$this->isSystemDefaultEqual = (int)$xml->isSystemDefaultEqual;
		$this->tagsEqual = (string)$xml->tagsEqual;
		$this->formatEqual = (string)$xml->formatEqual;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $systemNameEqual = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $systemNameIn = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_NullableBoolean
	 */
	public $isSystemDefaultEqual = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $tagsEqual = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_ContainerFormat
	 */
	public $formatEqual = null;


}

