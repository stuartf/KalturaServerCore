<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_ContentDistribution_Type_ConfigurableDistributionProfile extends Kaltura_Client_ContentDistribution_Type_DistributionProfile
{
	public function getKalturaObjectType()
	{
		return 'KalturaConfigurableDistributionProfile';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(empty($xml->fieldConfigArray))
			$this->fieldConfigArray = array();
		else
			$this->fieldConfigArray = Kaltura_Client_Client::unmarshalItem($xml->fieldConfigArray);
	}
	/**
	 * 
	 *
	 * @var array of KalturaDistributionFieldConfig
	 */
	public $fieldConfigArray;


}

