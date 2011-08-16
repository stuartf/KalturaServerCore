<?php

/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_ReportService extends Kaltura_Client_ServiceBase
{
	function __construct(Kaltura_Client_Client $client = null)
	{
		parent::__construct($client);
	}

	function getGraphs($reportType, Kaltura_Client_Type_ReportInputFilter $reportInputFilter, $dimension = null, $objectIds = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "reportType", $reportType);
		$this->client->addParam($kparams, "reportInputFilter", $reportInputFilter->toParams());
		$this->client->addParam($kparams, "dimension", $dimension);
		$this->client->addParam($kparams, "objectIds", $objectIds);
		$this->client->queueServiceActionCall("report", "getGraphs", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		if(!$resultObject)
			$resultObject = array();
		$this->client->validateObjectType($resultObject, "array");
		return $resultObject;
	}

	function getTotal($reportType, Kaltura_Client_Type_ReportInputFilter $reportInputFilter, $objectIds = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "reportType", $reportType);
		$this->client->addParam($kparams, "reportInputFilter", $reportInputFilter->toParams());
		$this->client->addParam($kparams, "objectIds", $objectIds);
		$this->client->queueServiceActionCall("report", "getTotal", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "Kaltura_Client_Type_ReportTotal");
		return $resultObject;
	}

	function getTable($reportType, Kaltura_Client_Type_ReportInputFilter $reportInputFilter, Kaltura_Client_Type_FilterPager $pager, $order = null, $objectIds = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "reportType", $reportType);
		$this->client->addParam($kparams, "reportInputFilter", $reportInputFilter->toParams());
		$this->client->addParam($kparams, "pager", $pager->toParams());
		$this->client->addParam($kparams, "order", $order);
		$this->client->addParam($kparams, "objectIds", $objectIds);
		$this->client->queueServiceActionCall("report", "getTable", $kparams);
		if ($this->client->isMultiRequest())
			return null;
		$resultObject = $this->client->doQueue();
		$this->client->throwExceptionIfError($resultObject);
		$this->client->validateObjectType($resultObject, "Kaltura_Client_Type_ReportTable");
		return $resultObject;
	}

	function getUrlForReportAsCsv($reportTitle, $reportText, $headers, $reportType, Kaltura_Client_Type_ReportInputFilter $reportInputFilter, $dimension = null, Kaltura_Client_Type_FilterPager $pager = null, $order = null, $objectIds = null)
	{
		$kparams = array();
		$this->client->addParam($kparams, "reportTitle", $reportTitle);
		$this->client->addParam($kparams, "reportText", $reportText);
		$this->client->addParam($kparams, "headers", $headers);
		$this->client->addParam($kparams, "reportType", $reportType);
		$this->client->addParam($kparams, "reportInputFilter", $reportInputFilter->toParams());
		$this->client->addParam($kparams, "dimension", $dimension);
		if ($pager !== null)
			$this->client->addParam($kparams, "pager", $pager->toParams());
		$this->client->addParam($kparams, "order", $order);
		$this->client->addParam($kparams, "objectIds", $objectIds);
		$this->client->queueServiceActionCall("report", "getUrlForReportAsCsv", $kparams);
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
