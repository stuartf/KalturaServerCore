<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_GenericXsltSyndicationFeed extends Kaltura_Client_Type_GenericSyndicationFeed
{
	public function getKalturaObjectType()
	{
		return 'KalturaGenericXsltSyndicationFeed';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->xslt = (string)$xml->xslt;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $xslt = null;


}

