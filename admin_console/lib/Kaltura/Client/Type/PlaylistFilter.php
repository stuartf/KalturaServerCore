<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_PlaylistFilter extends Kaltura_Client_Type_PlaylistBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaPlaylistFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

