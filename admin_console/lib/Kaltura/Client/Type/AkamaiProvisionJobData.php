<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_AkamaiProvisionJobData extends Kaltura_Client_Type_ProvisionJobData
{
	public function getKalturaObjectType()
	{
		return 'KalturaAkamaiProvisionJobData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->wsdlUsername = (string)$xml->wsdlUsername;
		$this->wsdlPassword = (string)$xml->wsdlPassword;
		$this->cpcode = (string)$xml->cpcode;
		$this->emailId = (string)$xml->emailId;
		$this->primaryContact = (string)$xml->primaryContact;
		$this->secondaryContact = (string)$xml->secondaryContact;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $wsdlUsername = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $wsdlPassword = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $cpcode = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $emailId = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $primaryContact = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $secondaryContact = null;


}

