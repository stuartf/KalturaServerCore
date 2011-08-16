<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_DirectoryRestriction extends Kaltura_Client_Type_BaseRestriction
{
	public function getKalturaObjectType()
	{
		return 'KalturaDirectoryRestriction';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->directoryRestrictionType))
			$this->directoryRestrictionType = (int)$xml->directoryRestrictionType;
	}
	/**
	 * Kaltura directory restriction type
	 * 
	 *
	 * @var Kaltura_Client_Enum_DirectoryRestrictionType
	 */
	public $directoryRestrictionType = null;


}

