<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Metadata_Type_UpgradeMetadataResponse extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaUpgradeMetadataResponse';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->totalCount))
			$this->totalCount = (int)$xml->totalCount;
		if(count($xml->lowerVersionCount))
			$this->lowerVersionCount = (int)$xml->lowerVersionCount;
	}
	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $totalCount = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $lowerVersionCount = null;


}

