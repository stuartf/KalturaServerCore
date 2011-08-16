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
class KalturaYoutubeApiDistributionProfileOrderBy
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
class KalturaYoutubeApiDistributionProviderOrderBy
{
}

/**
 * @package Scheduler
 * @subpackage Client
 */
abstract class KalturaYoutubeApiDistributionProfileBaseFilter extends KalturaDistributionProfileFilter
{

}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaYoutubeApiDistributionProfileFilter extends KalturaYoutubeApiDistributionProfileBaseFilter
{

}

/**
 * @package Scheduler
 * @subpackage Client
 */
abstract class KalturaYoutubeApiDistributionProviderBaseFilter extends KalturaDistributionProviderFilter
{

}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaYoutubeApiDistributionProviderFilter extends KalturaYoutubeApiDistributionProviderBaseFilter
{

}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaYoutubeApiDistributionProfile extends KalturaDistributionProfile
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
	public $password = null;

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
	 * @var int
	 */
	public $metadataProfileId = null;


}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaYoutubeApiDistributionClientPlugin extends KalturaClientPlugin
{
	/**
	 * @var KalturaYoutubeApiDistributionClientPlugin
	 */
	protected static $instance;

	protected function __construct(KalturaClient $client)
	{
		parent::__construct($client);
	}

	/**
	 * @return KalturaYoutubeApiDistributionClientPlugin
	 */
	public static function get(KalturaClient $client)
	{
		if(!self::$instance)
			self::$instance = new KalturaYoutubeApiDistributionClientPlugin($client);
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
		return 'youtubeApiDistribution';
	}
}

