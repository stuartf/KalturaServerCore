<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_YouTubeDistribution_Type_YouTubeDistributionProfile extends Kaltura_Client_ContentDistribution_Type_ConfigurableDistributionProfile
{
	public function getKalturaObjectType()
	{
		return 'KalturaYouTubeDistributionProfile';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->username = (string)$xml->username;
		$this->notificationEmail = (string)$xml->notificationEmail;
		$this->sftpHost = (string)$xml->sftpHost;
		$this->sftpLogin = (string)$xml->sftpLogin;
		$this->sftpPublicKey = (string)$xml->sftpPublicKey;
		$this->sftpPrivateKey = (string)$xml->sftpPrivateKey;
		$this->sftpBaseDir = (string)$xml->sftpBaseDir;
		$this->ownerName = (string)$xml->ownerName;
		$this->defaultCategory = (string)$xml->defaultCategory;
		$this->allowComments = (string)$xml->allowComments;
		$this->allowEmbedding = (string)$xml->allowEmbedding;
		$this->allowRatings = (string)$xml->allowRatings;
		$this->allowResponses = (string)$xml->allowResponses;
		$this->commercialPolicy = (string)$xml->commercialPolicy;
		$this->ugcPolicy = (string)$xml->ugcPolicy;
		$this->target = (string)$xml->target;
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
	public $notificationEmail = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $sftpHost = null;

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
	public $sftpPublicKey = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $sftpPrivateKey = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $sftpBaseDir = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $ownerName = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $defaultCategory = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $allowComments = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $allowEmbedding = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $allowRatings = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $allowResponses = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $commercialPolicy = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $ugcPolicy = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $target = null;


}

