<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_ContentDistribution_Type_DistributionJobData extends Kaltura_Client_Type_JobData
{
	public function getKalturaObjectType()
	{
		return 'KalturaDistributionJobData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->distributionProfileId))
			$this->distributionProfileId = (int)$xml->distributionProfileId;
		if(!empty($xml->distributionProfile))
			$this->distributionProfile = Kaltura_Client_Client::unmarshalItem($xml->distributionProfile);
		if(count($xml->entryDistributionId))
			$this->entryDistributionId = (int)$xml->entryDistributionId;
		if(!empty($xml->entryDistribution))
			$this->entryDistribution = Kaltura_Client_Client::unmarshalItem($xml->entryDistribution);
		$this->remoteId = (string)$xml->remoteId;
		$this->providerType = (string)$xml->providerType;
		if(!empty($xml->providerData))
			$this->providerData = Kaltura_Client_Client::unmarshalItem($xml->providerData);
		$this->results = (string)$xml->results;
		$this->sentData = (string)$xml->sentData;
		if(empty($xml->mediaFiles))
			$this->mediaFiles = array();
		else
			$this->mediaFiles = Kaltura_Client_Client::unmarshalItem($xml->mediaFiles);
	}
	/**
	 * 
	 *
	 * @var int
	 */
	public $distributionProfileId = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_ContentDistribution_Type_DistributionProfile
	 */
	public $distributionProfile;

	/**
	 * 
	 *
	 * @var int
	 */
	public $entryDistributionId = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_ContentDistribution_Type_EntryDistribution
	 */
	public $entryDistribution;

	/**
	 * Id of the media in the remote system
	 *
	 * @var string
	 */
	public $remoteId = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_ContentDistribution_Enum_DistributionProviderType
	 */
	public $providerType = null;

	/**
	 * Additional data that relevant for the provider only
	 *
	 * @var Kaltura_Client_ContentDistribution_Type_DistributionJobProviderData
	 */
	public $providerData;

	/**
	 * The results as returned from the remote destination
	 *
	 * @var string
	 */
	public $results = null;

	/**
	 * The data as sent to the remote destination
	 *
	 * @var string
	 */
	public $sentData = null;

	/**
	 * Stores array of media files that submitted to the destination site
	 * Could be used later for media update 
	 *
	 * @var array of KalturaDistributionRemoteMediaFile
	 */
	public $mediaFiles;


}

