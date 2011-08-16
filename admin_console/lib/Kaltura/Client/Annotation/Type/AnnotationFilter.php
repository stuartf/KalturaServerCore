<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Annotation_Type_AnnotationFilter extends Kaltura_Client_Annotation_Type_AnnotationBaseFilter
{
	public function getKalturaObjectType()
	{
		return 'KalturaAnnotationFilter';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
	}

}

