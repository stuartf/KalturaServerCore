<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_BulkUploadXml_Type_BulkUploadXmlJobData extends Kaltura_Client_Type_BulkUploadJobData
{
	public function getKalturaObjectType()
	{
		return 'KalturaBulkUploadXmlJobData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

