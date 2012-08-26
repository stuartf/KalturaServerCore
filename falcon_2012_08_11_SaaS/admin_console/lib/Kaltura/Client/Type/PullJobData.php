<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_PullJobData extends Kaltura_Client_Type_JobData
{
	public function getKalturaObjectType()
	{
		return 'KalturaPullJobData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->srcFileUrl = (string)$xml->srcFileUrl;
		$this->destFileLocalPath = (string)$xml->destFileLocalPath;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $srcFileUrl = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $destFileLocalPath = null;


}

