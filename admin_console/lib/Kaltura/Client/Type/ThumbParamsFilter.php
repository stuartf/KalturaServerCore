<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_ThumbParamsFilter extends Kaltura_Client_Type_ThumbParamsBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaThumbParamsFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

