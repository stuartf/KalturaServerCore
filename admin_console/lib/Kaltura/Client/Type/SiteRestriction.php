<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_SiteRestriction extends Kaltura_Client_Type_BaseRestriction
{
	public function getKalturaObjectType()
	{
		return 'KalturaSiteRestriction';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->siteRestrictionType))
			$this->siteRestrictionType = (int)$xml->siteRestrictionType;
		$this->siteList = (string)$xml->siteList;
	}
	/**
	 * The site restriction type (allow or deny)
	 * 
	 *
	 * @var Kaltura_Client_Enum_SiteRestrictionType
	 */
	public $siteRestrictionType = null;

	/**
	 * Comma separated list of sites (domains) to allow or deny
	 * 
	 *
	 * @var string
	 */
	public $siteList = null;


}

