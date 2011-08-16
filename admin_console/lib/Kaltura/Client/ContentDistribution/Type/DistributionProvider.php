<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_ContentDistribution_Type_DistributionProvider extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaDistributionProvider';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->type = (string)$xml->type;
		$this->name = (string)$xml->name;
		if(!empty($xml->scheduleUpdateEnabled))
			$this->scheduleUpdateEnabled = true;
		if(!empty($xml->availabilityUpdateEnabled))
			$this->availabilityUpdateEnabled = true;
		if(!empty($xml->deleteInsteadUpdate))
			$this->deleteInsteadUpdate = true;
		if(count($xml->intervalBeforeSunrise))
			$this->intervalBeforeSunrise = (int)$xml->intervalBeforeSunrise;
		if(count($xml->intervalBeforeSunset))
			$this->intervalBeforeSunset = (int)$xml->intervalBeforeSunset;
		$this->updateRequiredEntryFields = (string)$xml->updateRequiredEntryFields;
		$this->updateRequiredMetadataXPaths = (string)$xml->updateRequiredMetadataXPaths;
	}
	/**
	 * 
	 *
	 * @var Kaltura_Client_ContentDistribution_Enum_DistributionProviderType
	 * @readonly
	 */
	public $type = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $name = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	public $scheduleUpdateEnabled = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	public $availabilityUpdateEnabled = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	public $deleteInsteadUpdate = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $intervalBeforeSunrise = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $intervalBeforeSunset = null;

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

