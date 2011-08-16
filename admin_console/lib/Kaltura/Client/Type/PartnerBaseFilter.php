<?php
/**
 * @package Admin
 * @subpackage Client
 */
abstract class Kaltura_Client_Type_PartnerBaseFilter extends Kaltura_Client_Type_Filter
{
	public function getKalturaObjectType()
	{
		return 'KalturaPartnerBaseFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->idEqual))
			$this->idEqual = (int)$xml->idEqual;
		$this->idIn = (string)$xml->idIn;
		$this->nameLike = (string)$xml->nameLike;
		$this->nameMultiLikeOr = (string)$xml->nameMultiLikeOr;
		$this->nameMultiLikeAnd = (string)$xml->nameMultiLikeAnd;
		$this->nameEqual = (string)$xml->nameEqual;
		if(count($xml->statusEqual))
			$this->statusEqual = (int)$xml->statusEqual;
		$this->statusIn = (string)$xml->statusIn;
		if(count($xml->partnerPackageEqual))
			$this->partnerPackageEqual = (int)$xml->partnerPackageEqual;
		if(count($xml->partnerPackageGreaterThanOrEqual))
			$this->partnerPackageGreaterThanOrEqual = (int)$xml->partnerPackageGreaterThanOrEqual;
		if(count($xml->partnerPackageLessThanOrEqual))
			$this->partnerPackageLessThanOrEqual = (int)$xml->partnerPackageLessThanOrEqual;
		$this->partnerNameDescriptionWebsiteAdminNameAdminEmailLike = (string)$xml->partnerNameDescriptionWebsiteAdminNameAdminEmailLike;
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
	 * @var string
	 */
	public $idIn = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $nameLike = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $nameMultiLikeOr = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $nameMultiLikeAnd = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $nameEqual = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $statusEqual = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $statusIn = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $partnerPackageEqual = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $partnerPackageGreaterThanOrEqual = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $partnerPackageLessThanOrEqual = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $partnerNameDescriptionWebsiteAdminNameAdminEmailLike = null;


}

