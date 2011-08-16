<?php

/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Audit_AuditTrailService extends Kaltura_Client_ServiceBase
{
	function __construct(Kaltura_Client_Client $client = null)
	{
		parent::__construct($client);
	}

	function listAction(Kaltura_Client_Audit_Type_AuditTrailFilter $filter = null, Kaltura_Client_Type_FilterPager $pager = null)
	{
		$kparams = array();
		if ($filter !== null)
			$this->client->addParam($kparams, "filter", $filter->toParams());
		if ($pager !== null)
			$this->client->addParam($kparams, "pager", $pager->toParams());
		$this->client->queueServiceActionCall("audit_audittrail", "list", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "Kaltura_Client_Audit_Type_AuditTrailListResponse");
		return $resultObject;
	}

	function add(Kaltura_Client_Audit_Type_AuditTrail $auditTrail)
	{
		$kparams = array();
		$this->client->addParam($kparams, "auditTrail", $auditTrail->toParams());
		$this->client->queueServiceActionCall("audit_audittrail", "add", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "Kaltura_Client_Audit_Type_AuditTrail");
		return $resultObject;
	}

	function get($id)
	{
		$kparams = array();
		$this->client->addParam($kparams, "id", $id);
		$this->client->queueServiceActionCall("audit_audittrail", "get", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "Kaltura_Client_Audit_Type_AuditTrail");
		return $resultObject;
	}
}
