<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_UserFilter extends Kaltura_Client_Type_UserBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaUserFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->idEqual = (string)$xml->idEqual;
		$this->idIn = (string)$xml->idIn;
		if(!empty($xml->loginEnabledEqual))
			$this->loginEnabledEqual = true;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $idEqual = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $idIn = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	public $loginEnabledEqual = null;


}

