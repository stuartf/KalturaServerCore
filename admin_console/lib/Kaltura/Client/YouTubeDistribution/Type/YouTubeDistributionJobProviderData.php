<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_YouTubeDistribution_Type_YouTubeDistributionJobProviderData extends Kaltura_Client_ContentDistribution_Type_ConfigurableDistributionJobProviderData
{
	public function getKalturaObjectType()
	{
		return 'KalturaYouTubeDistributionJobProviderData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->videoAssetFilePath = (string)$xml->videoAssetFilePath;
		$this->thumbAssetFilePath = (string)$xml->thumbAssetFilePath;
		$this->sftpDirectory = (string)$xml->sftpDirectory;
		$this->sftpMetadataFilename = (string)$xml->sftpMetadataFilename;
		$this->currentPlaylists = (string)$xml->currentPlaylists;
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
	public $sftpDirectory = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $sftpMetadataFilename = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $currentPlaylists = null;


}

