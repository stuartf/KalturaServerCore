<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_ContentDistribution_Type_GenericDistributionProfile extends Kaltura_Client_ContentDistribution_Type_DistributionProfile
{
	public function getKalturaObjectType()
	{
		return 'KalturaGenericDistributionProfile';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->genericProviderId))
			$this->genericProviderId = (int)$xml->genericProviderId;
		if(!empty($xml->submitAction))
			$this->submitAction = Kaltura_Client_Client::unmarshalItem($xml->submitAction);
		if(!empty($xml->updateAction))
			$this->updateAction = Kaltura_Client_Client::unmarshalItem($xml->updateAction);
		if(!empty($xml->deleteAction))
			$this->deleteAction = Kaltura_Client_Client::unmarshalItem($xml->deleteAction);
		if(!empty($xml->fetchReportAction))
			$this->fetchReportAction = Kaltura_Client_Client::unmarshalItem($xml->fetchReportAction);
		$this->updateRequiredEntryFields = (string)$xml->updateRequiredEntryFields;
		$this->updateRequiredMetadataXPaths = (string)$xml->updateRequiredMetadataXPaths;
	}
	/**
	 * 
	 *
	 * @var int
	 * @insertonly
	 */
	public $genericProviderId = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_ContentDistribution_Type_GenericDistributionProfileAction
	 */
	public $submitAction;

	/**
	 * 
	 *
	 * @var Kaltura_Client_ContentDistribution_Type_GenericDistributionProfileAction
	 */
	public $updateAction;

	/**
	 * 
	 *
	 * @var Kaltura_Client_ContentDistribution_Type_GenericDistributionProfileAction
	 */
	public $deleteAction;

	/**
	 * 
	 *
	 * @var Kaltura_Client_ContentDistribution_Type_GenericDistributionProfileAction
	 */
	public $fetchReportAction;

	/**
	 * 
	 *
	 * @var string
	 */
	public $updateRequiredEntryFields = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $updateRequiredMetadataXPaths = null;


}

