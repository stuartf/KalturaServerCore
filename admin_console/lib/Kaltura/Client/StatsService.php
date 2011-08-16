<?php

/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_StatsService extends Kaltura_Client_ServiceBase
{
	function __construct(Kaltura_Client_Client $client = null)
	{
		parent::__construct($client);
	}

	function collect(Kaltura_Client_Type_StatsEvent $event)
	{
		$kparams = array();
		$this->client->addParam($kparams, "event", $event->toParams());
		$this->client->queueServiceActionCall("stats", "collect", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		return $resultObject;
	}

	function kmcCollect(Kaltura_Client_Type_StatsKmcEvent $kmcEvent)
	{
		$kparams = array();
		$this->client->addParam($kparams, "kmcEvent", $kmcEvent->toParams());
		$this->client->queueServiceActionCall("stats", "kmcCollect", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		return $resultObject;
	}

	function reportKceError(Kaltura_Client_Type_CEError $kalturaCEError)
	{
		$kparams = array();
		$this->client->addParam($kparams, "kalturaCEError", $kalturaCEError->toParams());
		$this->client->queueServiceActionCall("stats", "reportKceError", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "Kaltura_Client_Type_CEError");
		return $resultObject;
	}
}
