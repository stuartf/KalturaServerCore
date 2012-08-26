<?php
class Kaltura_Client_Type_FtpDropFolder extends Kaltura_Client_DropFolder_Type_RemoteDropFolder
{
	public function getKalturaObjectType()
	{
		return 'KalturaFtpDropFolder';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->host = (string)$xml->host;
		if(count($xml->port))
			$this->port = (int)$xml->port;
		$this->username = (string)$xml->username;
		$this->password = (string)$xml->password;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $host = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $port = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $username = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $password = null;


}

