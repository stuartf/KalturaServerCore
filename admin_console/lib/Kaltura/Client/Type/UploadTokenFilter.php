<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_UploadTokenFilter extends Kaltura_Client_Type_UploadTokenBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaUploadTokenFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

