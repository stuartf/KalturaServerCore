<?php

/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_ContentDistribution_TvComService extends Kaltura_Client_ServiceBase
{
	function __construct(Kaltura_Client_Client $client = null)
	{
		parent::__construct($client);
	}

	function getFeed($distributionProfileId, $hash)
	{
		$kparams = array();
		$this->client->addParam($kparams, "distributionProfileId", $distributionProfileId);
		$this->client->addParam($kparams, "hash", $hash);
		$this->client->queueServiceActionCall("tvcomdistribution_tvcom", "getFeed", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		return $resultObject;
	}
}
