<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_ExampleDistribution_Type_ExampleDistributionProfile extends Kaltura_Client_ContentDistribution_Type_DistributionProfile
{
	public function getKalturaObjectType()
	{
		return 'KalturaExampleDistributionProfile';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->username = (string)$xml->username;
		$this->password = (string)$xml->password;
		$this->accountId = (string)$xml->accountId;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $username = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $password = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $accountId = null;


}

