<?php
/**
 * @package Scheduler
 * @subpackage Client
 */
require_once(dirname(__FILE__) . "/../KalturaClientBase.php");
require_once(dirname(__FILE__) . "/../KalturaEnums.php");
require_once(dirname(__FILE__) . "/../KalturaTypes.php");

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaYouTubeDistributionField
{
	const NOTIFICATION_EMAIL = "NOTIFICATION_EMAIL";
	const ACCOUNT_USERNAME = "ACCOUNT_USERNAME";
	const OWNER_NAME = "OWNER_NAME";
	const TARGET = "TARGET";
	const DATE_RECORDED = "DATE_RECORDED";
	const LANGUAGE = "LANGUAGE";
	const START_TIME = "START_TIME";
	const END_TIME = "END_TIME";
	const MEDIA_TITLE = "MEDIA_TITLE";
	const MEDIA_DESCRIPTION = "MEDIA_DESCRIPTION";
	const MEDIA_KEYWORDS = "MEDIA_KEYWORDS";
	const MEDIA_CATEGORY = "MEDIA_CATEGORY";
	const MEDIA_RATING = "MEDIA_RATING";
	const ALLOW_COMMENTS = "ALLOW_COMMENTS";
	const ALLOW_RESPONSES = "ALLOW_RESPONSES";
	const ALLOW_RATINGS = "ALLOW_RATINGS";
	const ALLOW_EMBEDDING = "ALLOW_EMBEDDING";
	const POLICY_COMMERCIAL = "POLICY_COMMERCIAL";
	const POLICY_UGC = "POLICY_UGC";
	const WEB_METADATA_CUSTOM_ID = "WEB_METADATA_CUSTOM_ID";
	const TV_METADATA_CUSTOM_ID = "TV_METADATA_CUSTOM_ID";
	const TV_METADATA_EPISODE = "TV_METADATA_EPISODE";
	const TV_METADATA_EPISODE_TITLE = "TV_METADATA_EPISODE_TITLE";
	const TV_METADATA_SHOW_TITLE = "TV_METADATA_SHOW_TITLE";
	const TV_METADATA_SEASON = "TV_METADATA_SEASON";
	const PLAYLISTS = "PLAYLISTS";
}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaYouTubeDistributionClientPlugin extends KalturaClientPlugin
{
	/**
	 * @var KalturaYouTubeDistributionClientPlugin
	 */
	protected static $instance;

	protected function __construct(KalturaClient $client)
	{
		parent::__construct($client);
	}

	/**
	 * @return KalturaYouTubeDistributionClientPlugin
	 */
	public static function get(KalturaClient $client)
	{
		if(!self::$instance)
			self::$instance = new KalturaYouTubeDistributionClientPlugin($client);
		return self::$instance;
	}

	/**
	 * @return array<KalturaServiceBase>
	 */
	public function getServices()
	{
		$services = array(
		);
		return $services;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return 'youTubeDistribution';
	}
}

