<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_FreewheelDistribution_Type_FreewheelDistributionProfile extends Kaltura_Client_ContentDistribution_Type_DistributionProfile
{
	public function getKalturaObjectType()
	{
		return 'KalturaFreewheelDistributionProfile';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->apikey = (string)$xml->apikey;
		$this->email = (string)$xml->email;
		$this->sftpLogin = (string)$xml->sftpLogin;
		$this->sftpPass = (string)$xml->sftpPass;
		$this->accountId = (string)$xml->accountId;
		if(count($xml->metadataProfileId))
			$this->metadataProfileId = (int)$xml->metadataProfileId;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $apikey = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $email = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $sftpLogin = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $sftpPass = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $accountId = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $metadataProfileId = null;


}

