<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_ContentDistribution_Type_DistributionValidationErrorInvalidMetadata extends Kaltura_Client_ContentDistribution_Type_DistributionValidationErrorInvalidData
{
	public function getKalturaObjectType()
	{
		return 'KalturaDistributionValidationErrorInvalidMetadata';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->metadataProfileId))
			$this->metadataProfileId = (int)$xml->metadataProfileId;
	}
	/**
	 * 
	 *
	 * @var int
	 */
	public $metadataProfileId = null;


}

