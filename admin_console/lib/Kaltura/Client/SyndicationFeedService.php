<?php

/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_SyndicationFeedService extends Kaltura_Client_ServiceBase
{
	function __construct(Kaltura_Client_Client $client = null)
	{
		parent::__construct($client);
	}

	function add(Kaltura_Client_Type_BaseSyndicationFeed $syndicationFeed)
	{
		$kparams = array();
		$this->client->addParam($kparams, "syndicationFeed", $syndicationFeed->toParams());
		$this->client->queueServiceActionCall("syndicationfeed", "add", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "Kaltura_Client_Type_BaseSyndicationFeed");
		return $resultObject;
	}

	function get($id)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->queueServiceActionCall("syndicationfeed", "get", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "Kaltura_Client_Type_BaseSyndicationFeed");
		return $resultObject;
	}

	function update($id, Kaltura_Client_Type_BaseSyndicationFeed $syndicationFeed)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "syndicationFeed", $syndicationFeed->toParams());
		$this->client->queueServiceActionCall("syndicationfeed", "update", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "Kaltura_Client_Type_BaseSyndicationFeed");
		return $resultObject;
	}

	function delete($id)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->queueServiceActionCall("syndicationfeed", "delete", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		return $resultObject;
	}

	function listAction(Kaltura_Client_Type_BaseSyndicationFeedFilter $filter = null, Kaltura_Client_Type_FilterPager $pager = null)
	{
		$kparams = array();
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		if ($pager !== null)
			$this->client->addParam($kparams, "pager", $pager->toParams());
		$this->client->queueServiceActionCall("syndicationfeed", "list", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "Kaltura_Client_Type_BaseSyndicationFeedListResponse");
		return $resultObject;
	}

	function getEntryCount($feedId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "feedId", $feedId);
		$this->client->queueServiceActionCall("syndicationfeed", "getEntryCount", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "Kaltura_Client_Type_SyndicationFeedEntryCount");
		return $resultObject;
	}

	function requestConversion($feedId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "feedId", $feedId);
		$this->client->queueServiceActionCall("syndicationfeed", "requestConversion", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		if(!$resultObject)
			$resultObject = array();
		$this->client->validateObjectType($resultObject, "string");
		return $resultObject;
	}
}
