<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_ConvertCollectionJobData extends Kaltura_Client_Type_ConvartableJobData
{
	public function getKalturaObjectType()
	{
		return 'KalturaConvertCollectionJobData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->destDirLocalPath = (string)$xml->destDirLocalPath;
		$this->destDirRemoteUrl = (string)$xml->destDirRemoteUrl;
		$this->destFileName = (string)$xml->destFileName;
		$this->inputXmlLocalPath = (string)$xml->inputXmlLocalPath;
		$this->inputXmlRemoteUrl = (string)$xml->inputXmlRemoteUrl;
		$this->commandLinesStr = (string)$xml->commandLinesStr;
		if(empty($xml->flavors))
			$this->flavors = array();
		else
			$this->flavors = Kaltura_Client_Client::unmarshalItem($xml->flavors);
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $destDirLocalPath = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $destDirRemoteUrl = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $destFileName = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $inputXmlLocalPath = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $inputXmlRemoteUrl = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $commandLinesStr = null;

	/**
	 * 
	 *
	 * @var array of KalturaConvertCollectionFlavorData
	 */
	public $flavors;


}

