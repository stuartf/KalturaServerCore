<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_BulkUploadCsv_Type_BulkUploadCsvJobData extends Kaltura_Client_Type_BulkUploadJobData
{
	public function getKalturaObjectType()
	{
		return 'KalturaBulkUploadCsvJobData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->csvVersion))
			$this->csvVersion = (int)$xml->csvVersion;
	}
	/**
	 * The version of the csv file
	 * 
	 *
	 * @var Kaltura_Client_BulkUploadCsv_Enum_BulkUploadCsvVersion
	 */
	public $csvVersion = null;


}

