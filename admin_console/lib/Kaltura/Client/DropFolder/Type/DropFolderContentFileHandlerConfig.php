<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_DropFolder_Type_DropFolderContentFileHandlerConfig extends Kaltura_Client_DropFolder_Type_DropFolderFileHandlerConfig
{
	public function getKalturaObjectType()
	{
		return 'KalturaDropFolderContentFileHandlerConfig';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->contentMatchPolicy))
			$this->contentMatchPolicy = (int)$xml->contentMatchPolicy;
		$this->slugRegex = (string)$xml->slugRegex;
	}
	/**
	 * 
	 *
	 * @var Kaltura_Client_DropFolder_Enum_DropFolderContentFileHandlerMatchPolicy
	 */
	public $contentMatchPolicy = null;

	/**
	 * Regular expression that defines valid file names to be handled.
	 * The following might be extracted from the file name and used if defined:
	 * - (?P<referenceId>\w+) - will be used as the drop folder file's parsed slug.
	 * - (?P<flavorName>\w+)  - will be used as the drop folder file's parsed flavor.
	 * 
	 *
	 * @var string
	 */
	public $slugRegex = null;


}

