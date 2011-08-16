<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_ServerFileResource extends Kaltura_Client_Type_DataCenterContentResource
{
	public function getKalturaObjectType()
	{
		return 'KalturaServerFileResource';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->localFilePath = (string)$xml->localFilePath;
	}
	/**
	 * Full path to the local file 
	 *
	 * @var string
	 */
	public $localFilePath = null;


}

