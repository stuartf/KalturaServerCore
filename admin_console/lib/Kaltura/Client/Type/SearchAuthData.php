<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_SearchAuthData extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaSearchAuthData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->authData = (string)$xml->authData;
		$this->loginUrl = (string)$xml->loginUrl;
		$this->message = (string)$xml->message;
	}
	/**
	 * The authentication data that further should be used for search
	 * 
	 *
	 * @var string
	 */
	public $authData = null;

	/**
	 * Login URL when user need to sign-in and authorize the search
	 *
	 * @var string
	 */
	public $loginUrl = null;

	/**
	 * Information when there was an error
	 *
	 * @var string
	 */
	public $message = null;


}

