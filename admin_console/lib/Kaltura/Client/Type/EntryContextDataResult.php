<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_EntryContextDataResult extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaEntryContextDataResult';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(!empty($xml->isSiteRestricted))
			$this->isSiteRestricted = true;
		if(!empty($xml->isCountryRestricted))
			$this->isCountryRestricted = true;
		if(!empty($xml->isSessionRestricted))
			$this->isSessionRestricted = true;
		if(!empty($xml->isIpAddressRestricted))
			$this->isIpAddressRestricted = true;
		if(count($xml->previewLength))
			$this->previewLength = (int)$xml->previewLength;
		if(!empty($xml->isScheduledNow))
			$this->isScheduledNow = true;
		if(!empty($xml->isAdmin))
			$this->isAdmin = true;
	}
	/**
	 * 
	 *
	 * @var bool
	 */
	public $isSiteRestricted = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	public $isCountryRestricted = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	public $isSessionRestricted = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	public $isIpAddressRestricted = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $previewLength = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	public $isScheduledNow = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	public $isAdmin = null;


}

