<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Metadata_Type_ImportMetadataJobData extends Kaltura_Client_Type_JobData
{
	public function getKalturaObjectType()
	{
		return 'KalturaImportMetadataJobData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->srcFileUrl = (string)$xml->srcFileUrl;
		$this->destFileLocalPath = (string)$xml->destFileLocalPath;
		if(count($xml->metadataId))
			$this->metadataId = (int)$xml->metadataId;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $srcFileUrl = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $destFileLocalPath = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $metadataId = null;


}

