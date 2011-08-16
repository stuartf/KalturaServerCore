<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_GenericSyndicationFeed extends Kaltura_Client_Type_BaseSyndicationFeed
{
	public function getKalturaObjectType()
	{
		return 'KalturaGenericSyndicationFeed';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->feedDescription = (string)$xml->feedDescription;
		$this->feedLandingPage = (string)$xml->feedLandingPage;
	}
	/**
	 * feed description
	 * 
	 *
	 * @var string
	 */
	public $feedDescription = null;

	/**
	 * feed landing page (i.e publisher website)
	 * 
	 *
	 * @var string
	 */
	public $feedLandingPage = null;


}

