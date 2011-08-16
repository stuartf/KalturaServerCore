<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_IpAddressRestriction extends Kaltura_Client_Type_BaseRestriction
{
	public function getKalturaObjectType()
	{
		return 'KalturaIpAddressRestriction';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->ipAddressRestrictionType))
			$this->ipAddressRestrictionType = (int)$xml->ipAddressRestrictionType;
		$this->ipAddressList = (string)$xml->ipAddressList;
	}
	/**
	 * Ip address restriction type (Allow or deny)
	 * 
	 *
	 * @var Kaltura_Client_Enum_IpAddressRestrictionType
	 */
	public $ipAddressRestrictionType = null;

	/**
	 * Comma separated list of ip address to allow to deny 
	 * 
	 *
	 * @var string
	 */
	public $ipAddressList = null;


}

