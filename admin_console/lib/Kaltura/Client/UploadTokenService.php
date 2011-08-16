<?php

/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_UploadTokenService extends Kaltura_Client_ServiceBase
{
	function __construct(Kaltura_Client_Client $client = null)
	{
		parent::__construct($client);
	}

	function add(Kaltura_Client_Type_UploadToken $uploadToken = null)
	{
		$kparams = array();
		if ($uploadToken !== null)
			$this->client->addParam($kparams, "uploadToken", $uploadToken->toParams());
		$this->client->queueServiceActionCall("uploadtoken", "add", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "Kaltura_Client_Type_UploadToken");
		return $resultObject;
	}

	function get($uploadTokenId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "uploadTokenId", $uploadTokenId);
		$this->client->queueServiceActionCall("uploadtoken", "get", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "Kaltura_Client_Type_UploadToken");
		return $resultObject;
	}

	function upload($uploadTokenId, $fileData, $resume = false, $finalChunk = true, $resumeAt = -1)
	{
		$kparams = array();
		$this->client->addParam($kparams, "uploadTokenId", $uploadTokenId);
		$kfiles = array();
		$this->client->addParam($kfiles, "fileData", $fileData);
		$this->client->addParam($kparams, "resume", $resume);
		$this->client->addParam($kparams, "finalChunk", $finalChunk);
		$this->client->addParam($kparams, "resumeAt", $resumeAt);
		$this->client->queueServiceActionCall("uploadtoken", "upload", $kparams, $kfiles);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "Kaltura_Client_Type_UploadToken");
		return $resultObject;
	}

	function delete($uploadTokenId)
	{
		$kparams = array();
		$this->client->addParam($kparams, "uploadTokenId", $uploadTokenId);
		$this->client->queueServiceActionCall("uploadtoken", "delete", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		return $resultObject;
	}

	function listAction(Kaltura_Client_Type_UploadTokenFilter $filter = null, Kaltura_Client_Type_FilterPager $pager = null)
	{
		$kparams = array();
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		if ($pager !== null)
			$this->client->addParam($kparams, "pager", $pager->toParams());
		$this->client->queueServiceActionCall("uploadtoken", "list", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "Kaltura_Client_Type_UploadTokenListResponse");
		return $resultObject;
	}
}
