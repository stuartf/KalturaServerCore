<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_ContentDistribution_Type_GenericDistributionJobProviderData extends Kaltura_Client_ContentDistribution_Type_DistributionJobProviderData
{
	public function getKalturaObjectType()
	{
		return 'KalturaGenericDistributionJobProviderData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->xml = (string)$xml->xml;
		$this->resultParseData = (string)$xml->resultParseData;
		if(count($xml->resultParserType))
			$this->resultParserType = (int)$xml->resultParserType;
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
	 * @var string
	 */
	public $resultParseData = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_ContentDistribution_Enum_GenericDistributionProviderParser
	 */
	public $resultParserType = null;


}

