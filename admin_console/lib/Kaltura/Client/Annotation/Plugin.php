<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Annotation_Plugin extends Kaltura_Client_Plugin
{
	/**
	 * @var Kaltura_Client_Annotation_Plugin
	 */
	protected static $instance;

	/**
	 * @var Kaltura_Client_Annotation_AnnotationService
	 */
	public $annotation = null;

	protected function __construct(Kaltura_Client_Client $client)
	{
		parent::__construct($client);
		$this->annotation = new Kaltura_Client_Annotation_AnnotationService($client);
	}

	/**
	 * @return Kaltura_Client_Annotation_Plugin
	 */
	public static function get(Kaltura_Client_Client $client)
	{
		if(!self::$instance)
			self::$instance = new Kaltura_Client_Annotation_Plugin($client);
		return self::$instance;
	}

	/**
	 * @return array<Kaltura_Client_ServiceBase>
	 */
	public function getServices()
	{
		$services = array(
			'annotation' => $this->annotation,
		);
		return $services;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return 'annotation';
	}
}

