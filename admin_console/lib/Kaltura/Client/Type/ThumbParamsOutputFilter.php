<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_ThumbParamsOutputFilter extends Kaltura_Client_Type_ThumbParamsOutputBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaThumbParamsOutputFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

