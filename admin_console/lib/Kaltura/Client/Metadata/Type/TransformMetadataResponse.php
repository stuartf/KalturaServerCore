<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Metadata_Type_TransformMetadataResponse extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaTransformMetadataResponse';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(empty($xml->objects))
			$this->objects = array();
		else
			$this->objects = Kaltura_Client_Client::unmarshalItem($xml->objects);
		if(count($xml->totalCount))
			$this->totalCount = (int)$xml->totalCount;
		if(count($xml->lowerVersionCount))
			$this->lowerVersionCount = (int)$xml->lowerVersionCount;
	}
	/**
	 * 
	 *
	 * @var array of KalturaMetadata
	 * @readonly
	 */
	public $objects;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $totalCount = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $lowerVersionCount = null;


}

