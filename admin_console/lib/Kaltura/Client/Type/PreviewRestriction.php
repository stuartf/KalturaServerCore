<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_PreviewRestriction extends Kaltura_Client_Type_SessionRestriction
{
	public function getKalturaObjectType()
	{
		return 'KalturaPreviewRestriction';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->previewLength))
			$this->previewLength = (int)$xml->previewLength;
	}
	/**
	 * The preview restriction length 
	 * 
	 *
	 * @var int
	 */
	public $previewLength = null;


}

