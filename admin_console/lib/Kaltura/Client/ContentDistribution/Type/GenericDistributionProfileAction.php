<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_ContentDistribution_Type_GenericDistributionProfileAction extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaGenericDistributionProfileAction';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->protocol))
			$this->protocol = (int)$xml->protocol;
		$this->serverUrl = (string)$xml->serverUrl;
		$this->serverPath = (string)$xml->serverPath;
		$this->username = (string)$xml->username;
		$this->password = (string)$xml->password;
		if(!empty($xml->ftpPassiveMode))
			$this->ftpPassiveMode = true;
		$this->httpFieldName = (string)$xml->httpFieldName;
		$this->httpFileName = (string)$xml->httpFileName;
	}
	/**
	 * 
	 *
	 * @var Kaltura_Client_ContentDistribution_Enum_DistributionProtocol
	 */
	public $protocol = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $serverUrl = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $serverPath = null;

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
	 * @var bool
	 */
	public $ftpPassiveMode = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $httpFieldName = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $httpFileName = null;


}

