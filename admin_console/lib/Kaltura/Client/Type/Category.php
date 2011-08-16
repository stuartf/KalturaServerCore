<?php
/**
 * @package Admin
 * @subpackage Client
 */
class Kaltura_Client_Type_Category extends Kaltura_Client_ObjectBase
{
	public function getKalturaObjectType()
	{
		return 'KalturaCategory';
	}
	
	public function __construct(SimpleXMLElement $xml = null)
	{
		parent::__construct($xml);
		
		if(is_null($xml))
			return;
		
		if(count($xml->id))
			$this->id = (int)$xml->id;
		if(count($xml->parentId))
			$this->parentId = (int)$xml->parentId;
		if(count($xml->depth))
			$this->depth = (int)$xml->depth;
		if(count($xml->partnerId))
			$this->partnerId = (int)$xml->partnerId;
		$this->name = (string)$xml->name;
		$this->fullName = (string)$xml->fullName;
		if(count($xml->entriesCount))
			$this->entriesCount = (int)$xml->entriesCount;
		if(count($xml->createdAt))
			$this->createdAt = (int)$xml->createdAt;
	}
	/**
	 * The id of the Category
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $id = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $parentId = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $depth = null;

	/**
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $partnerId = null;

	/**
	 * The name of the Category. 
	 * The following characters are not allowed: '<', '>', ','
	 * 
	 *
	 * @var string
	 */
	public $name = null;

	/**
	 * The full name of the Category
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $fullName = null;

	/**
	 * Number of entries in this Category (including child categories)
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $entriesCount = null;

	/**
	 * Creation date as Unix timestamp (In seconds)
	 * 
	 *
	 * @var int
	 * @readonly
	 */
	public $createdAt = null;


}

