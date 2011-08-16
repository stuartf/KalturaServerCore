<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_ExampleDistribution_Type_ExampleDistributionAssetPath extends Kaltura_Client_ContentDistribution_Type_DistributionJobProviderData
{
	public function getKalturaObjectType()
	{
		return 'KalturaExampleDistributionAssetPath';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->path = (string)$xml->path;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $path = null;


}

