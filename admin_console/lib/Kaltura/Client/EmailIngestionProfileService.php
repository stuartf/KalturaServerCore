<?php

/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_EmailIngestionProfileService extends Kaltura_Client_ServiceBase
{
	function __construct(Kaltura_Client_Client $client = null)
	{
		parent::__construct($client);
	}

	function add(Kaltura_Client_Type_EmailIngestionProfile $EmailIP)
	{
		$kparams = array();
		$this->client->addParam($kparams, "EmailIP", $EmailIP->toParams());
		$this->client->queueServiceActionCall("emailingestionprofile", "add", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "Kaltura_Client_Type_EmailIngestionProfile");
		return $resultObject;
	}

	function getByEmailAddress($emailAddress)
	{
		$kparams = array();
		$this->client->addParam($kparams, "emailAddress", $emailAddress);
		$this->client->queueServiceActionCall("emailingestionprofile", "getByEmailAddress", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "Kaltura_Client_Type_EmailIngestionProfile");
		return $resultObject;
	}

	function get($id)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->queueServiceActionCall("emailingestionprofile", "get", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "Kaltura_Client_Type_EmailIngestionProfile");
		return $resultObject;
	}

	function update($id, Kaltura_Client_Type_EmailIngestionProfile $EmailIP)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->addParam($kparams, "EmailIP", $EmailIP->toParams());
		$this->client->queueServiceActionCall("emailingestionprofile", "update", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "Kaltura_Client_Type_EmailIngestionProfile");
		return $resultObject;
	}

	function delete($id)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->queueServiceActionCall("emailingestionprofile", "delete", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		return $resultObject;
	}

	function addMediaEntry(Kaltura_Client_Type_MediaEntry $mediaEntry, $uploadTokenId, $emailProfId, $fromAddress, $emailMsgId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "mediaEntry", $mediaEntry->toParams());
		$this->client->addParam($kparams, "uploadTokenId", $uploadTokenId);
		$this->client->addParam($kparams, "emailProfId", $emailProfId);
		$this->client->addParam($kparams, "fromAddress", $fromAddress);
		$this->client->addParam($kparams, "emailMsgId", $emailMsgId);
		$this->client->queueServiceActionCall("emailingestionprofile", "addMediaEntry", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "Kaltura_Client_Type_MediaEntry");
		return $resultObject;
	}
}
