<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_BatchGetExclusiveNotificationJobsResponse extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaBatchGetExclusiveNotificationJobsResponse';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(empty($xml->notifications))
			$this->notifications = array();
		else
			$this->notifications = Kaltura_Client_Client::unmarshalItem($xml->notifications);
		if(empty($xml->partners))
			$this->partners = array();
		else
			$this->partners = Kaltura_Client_Client::unmarshalItem($xml->partners);
	}
	/**
	 * 
	 *
	 * @var array of KalturaNotification
	 * @readonly
	 */
	public $notifications;

	/**
	 * 
	 *
	 * @var array of KalturaPartner
	 * @readonly
	 */
	public $partners;


}

