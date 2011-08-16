<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_YoutubeApiDistribution_Type_YoutubeApiDistributionJobProviderData extends Kaltura_Client_ContentDistribution_Type_DistributionJobProviderData
{
	public function getKalturaObjectType()
	{
		return 'KalturaYoutubeApiDistributionJobProviderData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->videoAssetFilePath = (string)$xml->videoAssetFilePath;
		$this->thumbAssetFilePath = (string)$xml->thumbAssetFilePath;
		$this->playlists = (string)$xml->playlists;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $videoAssetFilePath = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $thumbAssetFilePath = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $playlists = null;


}

