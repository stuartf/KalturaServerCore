<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_UrlResource extends Kaltura_Client_Type_ContentResource
{
	public function getKalturaObjectType()
	{
		return 'KalturaUrlResource';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->url = (string)$xml->url;
	}
	/**
	 * Remote URL, FTP, HTTP or HTTPS 
	 *
	 * @var string
	 */
	public $url = null;


}

