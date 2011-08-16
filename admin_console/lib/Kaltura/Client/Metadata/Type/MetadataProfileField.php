<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Metadata_Type_MetadataProfileField extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaMetadataProfileField';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->id))
			$this->id = (int)$xml->id;
		$this->xPath = (string)$xml->xPath;
		$this->key = (string)$xml->key;
		$this->label = (string)$xml->label;
	}
	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $id = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $xPath = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $key = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $label = null;


}

