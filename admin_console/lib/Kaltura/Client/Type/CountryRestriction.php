<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_CountryRestriction extends Kaltura_Client_Type_BaseRestriction
{
	public function getKalturaObjectType()
	{
		return 'KalturaCountryRestriction';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->countryRestrictionType))
			$this->countryRestrictionType = (int)$xml->countryRestrictionType;
		$this->countryList = (string)$xml->countryList;
	}
	/**
	 * Country restriction type (Allow or deny)
	 * 
	 *
	 * @var Kaltura_Client_Enum_CountryRestrictionType
	 */
	public $countryRestrictionType = null;

	/**
	 * Comma separated list of country codes to allow to deny 
	 * 
	 *
	 * @var string
	 */
	public $countryList = null;


}

