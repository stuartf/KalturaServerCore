<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_SchedulerStatusResponse extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaSchedulerStatusResponse';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(empty($xml->queuesStatus))
			$this->queuesStatus = array();
		else
			$this->queuesStatus = Kaltura_Client_Client::unmarshalItem($xml->queuesStatus);
		if(empty($xml->controlPanelCommands))
			$this->controlPanelCommands = array();
		else
			$this->controlPanelCommands = Kaltura_Client_Client::unmarshalItem($xml->controlPanelCommands);
		if(empty($xml->schedulerConfigs))
			$this->schedulerConfigs = array();
		else
			$this->schedulerConfigs = Kaltura_Client_Client::unmarshalItem($xml->schedulerConfigs);
	}
	/**
	 * The status of all queues on the server
	 * 
	 *
	 * @var array of KalturaBatchQueuesStatus
	 */
	public $queuesStatus;

	/**
	 * The commands that sent from the control panel
	 * 
	 *
	 * @var array of KalturaControlPanelCommand
	 */
	public $controlPanelCommands;

	/**
	 * The configuration that sent from the control panel
	 * 
	 *
	 * @var array of KalturaSchedulerConfig
	 */
	public $schedulerConfigs;


}

