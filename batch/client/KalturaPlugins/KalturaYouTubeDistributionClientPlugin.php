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
class KalturaYouTubeDistributionProfileOrderBy
{
	const CREATED_AT_ASC = "+createdAt";
	const CREATED_AT_DESC = "-createdAt";
	const UPDATED_AT_ASC = "+updatedAt";
	const UPDATED_AT_DESC = "-updatedAt";
}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaYouTubeDistributionProviderOrderBy
{
}

/**
 * @package Scheduler
 * @subpackage Client
 */
abstract class KalturaYouTubeDistributionProfileBaseFilter extends KalturaConfigurableDistributionProfileFilter
{

}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaYouTubeDistributionProfileFilter extends KalturaYouTubeDistributionProfileBaseFilter
{

}

/**
 * @package Scheduler
 * @subpackage Client
 */
abstract class KalturaYouTubeDistributionProviderBaseFilter extends KalturaDistributionProviderFilter
{

}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaYouTubeDistributionProviderFilter extends KalturaYouTubeDistributionProviderBaseFilter
{

}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaYouTubeDistributionProfile extends KalturaConfigurableDistributionProfile
{
	/**
	 * 
	 *
	 * @var string
	 */
	public $username = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $notificationEmail = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $sftpHost = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $sftpLogin = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $sftpPublicKey = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $sftpPrivateKey = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $sftpBaseDir = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $ownerName = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $defaultCategory = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $allowComments = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $allowEmbedding = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $allowRatings = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $allowResponses = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $commercialPolicy = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $ugcPolicy = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $target = null;


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

