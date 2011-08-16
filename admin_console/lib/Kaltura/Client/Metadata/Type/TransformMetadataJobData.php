<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Metadata_Type_TransformMetadataJobData extends Kaltura_Client_Type_JobData
{
	public function getKalturaObjectType()
	{
		return 'KalturaTransformMetadataJobData';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		$this->srcXslPath = (string)$xml->srcXslPath;
		if(count($xml->srcVersion))
			$this->srcVersion = (int)$xml->srcVersion;
		if(count($xml->destVersion))
			$this->destVersion = (int)$xml->destVersion;
		$this->destXsdPath = (string)$xml->destXsdPath;
		if(count($xml->metadataProfileId))
			$this->metadataProfileId = (int)$xml->metadataProfileId;
	}
	/**
	 * 
	 *
	 * @var string
	 */
	public $srcXslPath = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $srcVersion = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $destVersion = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $destXsdPath = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $metadataProfileId = null;


}

