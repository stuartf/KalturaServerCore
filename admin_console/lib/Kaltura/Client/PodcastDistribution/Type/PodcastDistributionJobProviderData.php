<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_PodcastDistribution_Type_PodcastDistributionJobProviderData extends Kaltura_Client_ContentDistribution_Type_DistributionJobProviderData
{
	public function getKalturaObjectType()
	{
		return 'KalturaPodcastDistributionJobProviderData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->xml = (string)$xml->xml;
		if(count($xml->metadataProfileId))
			$this->metadataProfileId = (int)$xml->metadataProfileId;
		if(count($xml->distributionProfileId))
			$this->distributionProfileId = (int)$xml->distributionProfileId;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $xml = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $metadataProfileId = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $distributionProfileId = null;


}

