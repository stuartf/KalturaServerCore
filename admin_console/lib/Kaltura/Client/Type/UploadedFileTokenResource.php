<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_UploadedFileTokenResource extends Kaltura_Client_Type_DataCenterContentResource
{
	public function getKalturaObjectType()
	{
		return 'KalturaUploadedFileTokenResource';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->token = (string)$xml->token;
	}
	/**
	 * Token that returned from upload.upload action or uploadToken.add action. 
	 *
	 * @var string
	 */
	public $token = null;


}

