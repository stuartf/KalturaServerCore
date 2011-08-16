<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_ContentDistribution_Type_SyndicationDistributionProfile extends Kaltura_Client_ContentDistribution_Type_DistributionProfile
{
	public function getKalturaObjectType()
	{
		return 'KalturaSyndicationDistributionProfile';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->xsl = (string)$xml->xsl;
		$this->feedId = (string)$xml->feedId;
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


}

