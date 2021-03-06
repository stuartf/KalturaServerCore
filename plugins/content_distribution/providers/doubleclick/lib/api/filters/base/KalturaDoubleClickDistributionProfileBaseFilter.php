<?php
/**
 * @package plugins.doubleClickDistribution
 * @subpackage api.filters.base
 * @abstract
 */
abstract class KalturaDoubleClickDistributionProfileBaseFilter extends KalturaConfigurableDistributionProfileFilter
{
	static private $map_between_objects = array
	(
	);

	static private $order_by_map = array
	(
	);

	public function getMapBetweenObjects()
	{
		return array_merge(parent::getMapBetweenObjects(), KalturaDoubleClickDistributionProfileBaseFilter::$map_between_objects);
	}

	public function getOrderByMap()
	{
		return array_merge(parent::getOrderByMap(), KalturaDoubleClickDistributionProfileBaseFilter::$order_by_map);
	}
}
