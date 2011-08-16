<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_EntryResource extends Kaltura_Client_Type_ContentResource
{
	public function getKalturaObjectType()
	{
		return 'KalturaEntryResource';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->entryId = (string)$xml->entryId;
		if(count($xml->flavorParamsId))
			$this->flavorParamsId = (int)$xml->flavorParamsId;
	}
	/**
	 * ID of the source entry 
	 *
	 * @var string
	 */
	public $entryId = null;

	/**
	 * ID of the source flavor params, set to null to use the source flavor
	 *
	 * @var int
	 */
	public $flavorParamsId = null;


}

