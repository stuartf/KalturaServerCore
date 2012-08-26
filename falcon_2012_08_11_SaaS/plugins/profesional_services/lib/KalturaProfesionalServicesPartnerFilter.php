<?php
/**
 * @package api
 * @subpackage filters
 */
class KalturaProfesionalServicesPartnerFilter extends KalturaPartnerFilter
{
	private $map_between_objects = array
	(
		"commercialUseEqual" => "_eq_commercial_use",
		"partnerPackageEqual" => "_eq_partner_package",
		"partnerPackageGreaterThanOrEqual" => "_gte_partner_package",
		"partnerPackageLessThanOrEqual" => "_lte_partner_package",
	);

	public function getMapBetweenObjects()
	{
		return array_merge(parent::getMapBetweenObjects(), $this->map_between_objects);
	}

	/**
	 * @var KalturaCommercialUseType
	 */
	public $commercialUseEqual;

	/**
	 * @var int
	 */
	public $partnerPackageEqual;

	/**
	 * @var int
	 */
	public $partnerPackageGreaterThanOrEqual;

	/**
	 * @var int
	 */
	public $partnerPackageLessThanOrEqual;
}
