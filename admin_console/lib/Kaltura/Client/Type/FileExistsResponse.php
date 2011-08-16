<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_FileExistsResponse extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaFileExistsResponse';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(!empty($xml->exists))
			$this->exists = true;
		if(!empty($xml->sizeOk))
			$this->sizeOk = true;
	}
	/**
	 * Indicates if the file exists
	 * 
	 *
	 * @var bool
	 */
	public $exists = null;

	/**
	 * Indicates if the file size is right
	 * 
	 *
	 * @var bool
	 */
	public $sizeOk = null;


}

