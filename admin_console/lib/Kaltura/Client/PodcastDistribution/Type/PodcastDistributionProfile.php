<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_PodcastDistribution_Type_PodcastDistributionProfile extends Kaltura_Client_ContentDistribution_Type_DistributionProfile
{
	public function getKalturaObjectType()
	{
		return 'KalturaPodcastDistributionProfile';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->xsl = (string)$xml->xsl;
		$this->feedId = (string)$xml->feedId;
		if(count($xml->metadataProfileId))
			$this->metadataProfileId = (int)$xml->metadataProfileId;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $xsl = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $feedId = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $metadataProfileId = null;


}

