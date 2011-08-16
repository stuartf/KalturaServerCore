<?php

/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_SystemService extends Kaltura_Client_ServiceBase
{
	function __construct(Kaltura_Client_Client $client = null)
	{
		parent::__construct($client);
	}

	function ping()
	{
		$kparams = array();
		$this->client->queueServiceActionCall("system", "ping", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$resultObject = (bool) $resultObject;
		return $resultObject;
	}
}
