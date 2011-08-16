<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_DataEntry extends Kaltura_Client_Type_BaseEntry
{
	public function getKalturaObjectType()
	{
		return 'KalturaDataEntry';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->dataContent = (string)$xml->dataContent;
		if(!empty($xml->retrieveDataContentByGet))
			$this->retrieveDataContentByGet = true;
	}
	/**
	 * The data of the entry
	 *
	 * @var string
	 */
	public $dataContent = null;

	/**
	 * indicator whether to return the object for get action with the dataContent field.
	 *
	 * @var bool
	 * @insertonly
	 */
	public $retrieveDataContentByGet = null;


}

