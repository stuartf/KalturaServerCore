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
class KalturaTVComDistributionProfileOrderBy
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
class KalturaTVComDistributionProviderOrderBy
{
}

/**
 * @package Scheduler
 * @subpackage Client
 */
abstract class KalturaTVComDistributionProfileBaseFilter extends KalturaConfigurableDistributionProfileFilter
{

}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaTVComDistributionProfileFilter extends KalturaTVComDistributionProfileBaseFilter
{

}

/**
 * @package Scheduler
 * @subpackage Client
 */
abstract class KalturaTVComDistributionProviderBaseFilter extends KalturaDistributionProviderFilter
{

}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaTVComDistributionProviderFilter extends KalturaTVComDistributionProviderBaseFilter
{

}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaTVComDistributionProfile extends KalturaConfigurableDistributionProfile
{
	/**
	 * 
	 *
	 * @var int
	 */
	public $metadataProfileId = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $feedUrl = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $feedTitle = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $feedLink = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $feedDescription = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $feedLanguage = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $feedCopyright = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $feedImageTitle = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $feedImageUrl = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $feedImageLink = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $feedImageWidth = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $feedImageHeight = null;


}

/**
 * @package Scheduler
 * @subpackage Client
 */
class KalturaTvComDistributionClientPlugin extends KalturaClientPlugin
{
	/**
	 * @var KalturaTvComDistributionClientPlugin
	 */
	protected static $instance;

	protected function __construct(KalturaClient $client)
	{
		parent::__construct($client);
	}

	/**
	 * @return KalturaTvComDistributionClientPlugin
	 */
	public static function get(KalturaClient $client)
	{
		if(!self::$instance)
			self::$instance = new KalturaTvComDistributionClientPlugin($client);
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
		return 'tvComDistribution';
	}
}

