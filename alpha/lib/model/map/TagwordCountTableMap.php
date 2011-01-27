<?php


/**
 * This class defines the structure of the 'tagword_count' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class TagwordCountTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.TagwordCountTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
	  // attributes
		$this->setName('tagword_count');
		$this->setPhpName('TagwordCount');
		$this->setClassname('TagwordCount');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(false);
		// columns
		$this->addPrimaryKey('TAG', 'Tag', 'VARCHAR', true, 30, null);
		$this->addColumn('TAG_COUNT', 'TagCount', 'INTEGER', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
	} // buildRelations()

} // TagwordCountTableMap
