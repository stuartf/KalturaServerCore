<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_RemoteConvertJobData extends Kaltura_Client_Type_ConvartableJobData
{
	public function getKalturaObjectType()
	{
		return 'KalturaRemoteConvertJobData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->srcFileUrl = (string)$xml->srcFileUrl;
		$this->destFileUrl = (string)$xml->destFileUrl;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $srcFileUrl = null;

	/**
	 * Should be set by the API
	 * 
	 *
	 * @var string
	 */
	public $destFileUrl = null;


}

