<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_ContentDistribution_Type_GenericDistributionProviderAction extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaGenericDistributionProviderAction';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->id))
			$this->id = (int)$xml->id;
		if(count($xml->createdAt))
			$this->createdAt = (int)$xml->createdAt;
		if(count($xml->updatedAt))
			$this->updatedAt = (int)$xml->updatedAt;
		if(count($xml->genericDistributionProviderId))
			$this->genericDistributionProviderId = (int)$xml->genericDistributionProviderId;
		if(count($xml->action))
			$this->action = (int)$xml->action;
		if(count($xml->status))
			$this->status = (int)$xml->status;
		if(count($xml->resultsParser))
			$this->resultsParser = (int)$xml->resultsParser;
		if(count($xml->protocol))
			$this->protocol = (int)$xml->protocol;
		$this->serverAddress = (string)$xml->serverAddress;
		$this->remotePath = (string)$xml->remotePath;
		$this->remoteUsername = (string)$xml->remoteUsername;
		$this->remotePassword = (string)$xml->remotePassword;
		$this->editableFields = (string)$xml->editableFields;
		$this->mandatoryFields = (string)$xml->mandatoryFields;
		$this->mrssTransformer = (string)$xml->mrssTransformer;
		$this->mrssValidator = (string)$xml->mrssValidator;
		$this->resultsTransformer = (string)$xml->resultsTransformer;
	}
	/**
	 * Auto generated
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $id = null;

	/**
	 * Generic distribution provider action creation date as Unix timestamp (In seconds)
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $createdAt = null;

	/**
	 * Generic distribution provider action last update date as Unix timestamp (In seconds)
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $updatedAt = null;

	/**
	 * 
	 *
	 * @var int
	 * @insertonly
	 */
	public $genericDistributionProviderId = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_ContentDistribution_Enum_DistributionAction
	 * @insertonly
	 */
	public $action = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_ContentDistribution_Enum_GenericDistributionProviderStatus
	 * @readonly
	 */
	public $status = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_ContentDistribution_Enum_GenericDistributionProviderParser
	 */
	public $resultsParser = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_ContentDistribution_Enum_DistributionProtocol
	 */
	public $protocol = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $serverAddress = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $remotePath = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $remoteUsername = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $remotePassword = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $editableFields = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $mandatoryFields = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $mrssTransformer = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $mrssValidator = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $resultsTransformer = null;


}

