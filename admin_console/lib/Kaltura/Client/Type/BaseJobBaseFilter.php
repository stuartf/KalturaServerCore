<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_Type_BaseJobBaseFilter extends Kaltura_Client_Type_Filter
{
	public function getKalturaObjectType()
	{
		return 'KalturaBaseJobBaseFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->idEqual))
			$this->idEqual = (int)$xml->idEqual;
		if(count($xml->idGreaterThanOrEqual))
			$this->idGreaterThanOrEqual = (int)$xml->idGreaterThanOrEqual;
		if(count($xml->partnerIdEqual))
			$this->partnerIdEqual = (int)$xml->partnerIdEqual;
		$this->partnerIdIn = (string)$xml->partnerIdIn;
		$this->partnerIdNotIn = (string)$xml->partnerIdNotIn;
		if(count($xml->createdAtGreaterThanOrEqual))
			$this->createdAtGreaterThanOrEqual = (int)$xml->createdAtGreaterThanOrEqual;
		if(count($xml->createdAtLessThanOrEqual))
			$this->createdAtLessThanOrEqual = (int)$xml->createdAtLessThanOrEqual;
		if(count($xml->updatedAtGreaterThanOrEqual))
			$this->updatedAtGreaterThanOrEqual = (int)$xml->updatedAtGreaterThanOrEqual;
		if(count($xml->updatedAtLessThanOrEqual))
			$this->updatedAtLessThanOrEqual = (int)$xml->updatedAtLessThanOrEqual;
		if(count($xml->processorExpirationGreaterThanOrEqual))
			$this->processorExpirationGreaterThanOrEqual = (int)$xml->processorExpirationGreaterThanOrEqual;
		if(count($xml->processorExpirationLessThanOrEqual))
			$this->processorExpirationLessThanOrEqual = (int)$xml->processorExpirationLessThanOrEqual;
		if(count($xml->executionAttemptsGreaterThanOrEqual))
			$this->executionAttemptsGreaterThanOrEqual = (int)$xml->executionAttemptsGreaterThanOrEqual;
		if(count($xml->executionAttemptsLessThanOrEqual))
			$this->executionAttemptsLessThanOrEqual = (int)$xml->executionAttemptsLessThanOrEqual;
		if(count($xml->lockVersionGreaterThanOrEqual))
			$this->lockVersionGreaterThanOrEqual = (int)$xml->lockVersionGreaterThanOrEqual;
		if(count($xml->lockVersionLessThanOrEqual))
			$this->lockVersionLessThanOrEqual = (int)$xml->lockVersionLessThanOrEqual;
	}
	/**
	 * 
	 *
	 * @var int
	 */
	public $idEqual = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $idGreaterThanOrEqual = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $partnerIdEqual = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $partnerIdIn = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $partnerIdNotIn = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $createdAtGreaterThanOrEqual = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $createdAtLessThanOrEqual = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $updatedAtGreaterThanOrEqual = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $updatedAtLessThanOrEqual = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $processorExpirationGreaterThanOrEqual = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $processorExpirationLessThanOrEqual = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $executionAttemptsGreaterThanOrEqual = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $executionAttemptsLessThanOrEqual = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $lockVersionGreaterThanOrEqual = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $lockVersionLessThanOrEqual = null;


}

