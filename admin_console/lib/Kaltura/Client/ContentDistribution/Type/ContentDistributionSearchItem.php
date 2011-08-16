<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_ContentDistribution_Type_ContentDistributionSearchItem extends Kaltura_Client_Type_SearchItem
{
	public function getKalturaObjectType()
	{
		return 'KalturaContentDistributionSearchItem';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(!empty($xml->noDistributionProfiles))
			$this->noDistributionProfiles = true;
		if(count($xml->distributionProfileId))
			$this->distributionProfileId = (int)$xml->distributionProfileId;
		if(count($xml->distributionSunStatus))
			$this->distributionSunStatus = (int)$xml->distributionSunStatus;
		if(count($xml->entryDistributionFlag))
			$this->entryDistributionFlag = (int)$xml->entryDistributionFlag;
		if(count($xml->entryDistributionStatus))
			$this->entryDistributionStatus = (int)$xml->entryDistributionStatus;
		if(!empty($xml->hasEntryDistributionValidationErrors))
			$this->hasEntryDistributionValidationErrors = true;
		$this->entryDistributionValidationErrors = (string)$xml->entryDistributionValidationErrors;
	}
	/**
	 * 
	 *
	 * @var bool
	 */
	public $noDistributionProfiles = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $distributionProfileId = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_ContentDistribution_Enum_EntryDistributionSunStatus
	 */
	public $distributionSunStatus = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_ContentDistribution_Enum_EntryDistributionFlag
	 */
	public $entryDistributionFlag = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_ContentDistribution_Enum_EntryDistributionStatus
	 */
	public $entryDistributionStatus = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	public $hasEntryDistributionValidationErrors = null;

	/**
	 * Comma seperated validation error types
	 *
	 * @var string
	 */
	public $entryDistributionValidationErrors = null;


}

