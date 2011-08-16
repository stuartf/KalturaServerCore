<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_YoutubeApiDistribution_Type_YoutubeApiDistributionProfile extends Kaltura_Client_ContentDistribution_Type_DistributionProfile
{
	public function getKalturaObjectType()
	{
		return 'KalturaYoutubeApiDistributionProfile';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->username = (string)$xml->username;
		$this->password = (string)$xml->password;
		$this->defaultCategory = (string)$xml->defaultCategory;
		$this->allowComments = (string)$xml->allowComments;
		$this->allowEmbedding = (string)$xml->allowEmbedding;
		$this->allowRatings = (string)$xml->allowRatings;
		$this->allowResponses = (string)$xml->allowResponses;
		if(count($xml->metadataProfileId))
			$this->metadataProfileId = (int)$xml->metadataProfileId;
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
	 * @var int
	 */
	public $metadataProfileId = null;


}

