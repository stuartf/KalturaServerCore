<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_MailJobData extends Kaltura_Client_Type_JobData
{
	public function getKalturaObjectType()
	{
		return 'KalturaMailJobData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->mailType))
			$this->mailType = (int)$xml->mailType;
		if(count($xml->mailPriority))
			$this->mailPriority = (int)$xml->mailPriority;
		if(count($xml->status))
			$this->status = (int)$xml->status;
		$this->recipientName = (string)$xml->recipientName;
		$this->recipientEmail = (string)$xml->recipientEmail;
		if(count($xml->recipientId))
			$this->recipientId = (int)$xml->recipientId;
		$this->fromName = (string)$xml->fromName;
		$this->fromEmail = (string)$xml->fromEmail;
		$this->bodyParams = (string)$xml->bodyParams;
		$this->subjectParams = (string)$xml->subjectParams;
		$this->templatePath = (string)$xml->templatePath;
		if(count($xml->culture))
			$this->culture = (int)$xml->culture;
		if(count($xml->campaignId))
			$this->campaignId = (int)$xml->campaignId;
		if(count($xml->minSendDate))
			$this->minSendDate = (int)$xml->minSendDate;
		if(!empty($xml->isHtml))
			$this->isHtml = true;
	}
	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_MailType
	 */
	public $mailType = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $mailPriority = null;

	/**
	 * 
	 *
	 * @var Kaltura_Client_Enum_MailJobStatus
	 */
	public $status = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $recipientName = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $recipientEmail = null;

	/**
	 * kuserId  
	 *
	 * @var int
	 */
	public $recipientId = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $fromName = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $fromEmail = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $bodyParams = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $subjectParams = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $templatePath = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $culture = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $campaignId = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $minSendDate = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	public $isHtml = null;


}

