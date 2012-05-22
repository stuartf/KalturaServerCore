<?php

/**
 * @package infra
 * @subpackage cache
 */
class kApiCache
{
	/**
	 * @return int
	 */
	public static function getTime()
	{
		if (defined("KALTURA_API_V3"))
			KalturaResponseCacher::setConditionalCacheExpiry(600);
		return time();
	}
}
