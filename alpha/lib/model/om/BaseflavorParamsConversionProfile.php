<?php

/**
 * Base class that represents a row from the 'flavor_params_conversion_profile' table.
 *
 * 
 *
 * @package Core
 * @subpackage model.om
 */
abstract class BaseflavorParamsConversionProfile extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        flavorParamsConversionProfilePeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the conversion_profile_id field.
	 * @var        int
	 */
	protected $conversion_profile_id;

	/**
	 * The value for the flavor_params_id field.
	 * @var        int
	 */
	protected $flavor_params_id;

	/**
	 * The value for the system_name field.
	 * @var        string
	 */
	protected $system_name;

	/**
	 * The value for the origin field.
	 * @var        int
	 */
	protected $origin;

	/**
	 * The value for the ready_behavior field.
	 * @var        int
	 */
	protected $ready_behavior;

	/**
	 * The value for the force_none_complied field.
	 * @var        boolean
	 */
	protected $force_none_complied;

	/**
	 * The value for the created_at field.
	 * @var        string
	 */
	protected $created_at;

	/**
	 * The value for the updated_at field.
	 * @var        string
	 */
	protected $updated_at;

	/**
	 * @var        conversionProfile2
	 */
	protected $aconversionProfile2;

	/**
	 * @var        assetParams
	 */
	protected $aassetParams;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	/**
	 * Store columns old values before the changes
	 * @var        array
	 */
	protected $oldColumnsValues = array();
	
	/**
	 * @return array
	 */
	public function getColumnsOldValues()
	{
		return $this->oldColumnsValues;
	}

	/**
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [conversion_profile_id] column value.
	 * 
	 * @return     int
	 */
	public function getConversionProfileId()
	{
		return $this->conversion_profile_id;
	}

	/**
	 * Get the [flavor_params_id] column value.
	 * 
	 * @return     int
	 */
	public function getFlavorParamsId()
	{
		return $this->flavor_params_id;
	}

	/**
	 * Get the [system_name] column value.
	 * 
	 * @return     string
	 */
	public function getSystemName()
	{
		return $this->system_name;
	}

	/**
	 * Get the [origin] column value.
	 * 
	 * @return     int
	 */
	public function getOrigin()
	{
		return $this->origin;
	}

	/**
	 * Get the [ready_behavior] column value.
	 * 
	 * @return     int
	 */
	public function getReadyBehavior()
	{
		return $this->ready_behavior;
	}

	/**
	 * Get the [force_none_complied] column value.
	 * 
	 * @return     boolean
	 */
	public function getForceNoneComplied()
	{
		return $this->force_none_complied;
	}

	/**
	 * Get the [optionally formatted] temporal [created_at] column value.
	 * 
	 * This accessor only only work with unix epoch dates.  Consider enabling the propel.useDateTimeClass
	 * option in order to avoid converstions to integers (which are limited in the dates they can express).
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw unix timestamp integer will be returned.
	 * @return     mixed Formatted date/time value as string or (integer) unix timestamp (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{
		if ($this->created_at === null) {
			return null;
		}


		if ($this->created_at === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->created_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->created_at, true), $x);
			}
		}

		if ($format === null) {
			// We cast here to maintain BC in API; obviously we will lose data if we're dealing with pre-/post-epoch dates.
			return (int) $dt->format('U');
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [optionally formatted] temporal [updated_at] column value.
	 * 
	 * This accessor only only work with unix epoch dates.  Consider enabling the propel.useDateTimeClass
	 * option in order to avoid converstions to integers (which are limited in the dates they can express).
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw unix timestamp integer will be returned.
	 * @return     mixed Formatted date/time value as string or (integer) unix timestamp (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{
		if ($this->updated_at === null) {
			return null;
		}


		if ($this->updated_at === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->updated_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->updated_at, true), $x);
			}
		}

		if ($format === null) {
			// We cast here to maintain BC in API; obviously we will lose data if we're dealing with pre-/post-epoch dates.
			return (int) $dt->format('U');
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     flavorParamsConversionProfile The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if(!isset($this->oldColumnsValues[flavorParamsConversionProfilePeer::ID]))
			$this->oldColumnsValues[flavorParamsConversionProfilePeer::ID] = $this->id;

		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = flavorParamsConversionProfilePeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [conversion_profile_id] column.
	 * 
	 * @param      int $v new value
	 * @return     flavorParamsConversionProfile The current object (for fluent API support)
	 */
	public function setConversionProfileId($v)
	{
		if(!isset($this->oldColumnsValues[flavorParamsConversionProfilePeer::CONVERSION_PROFILE_ID]))
			$this->oldColumnsValues[flavorParamsConversionProfilePeer::CONVERSION_PROFILE_ID] = $this->conversion_profile_id;

		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->conversion_profile_id !== $v) {
			$this->conversion_profile_id = $v;
			$this->modifiedColumns[] = flavorParamsConversionProfilePeer::CONVERSION_PROFILE_ID;
		}

		if ($this->aconversionProfile2 !== null && $this->aconversionProfile2->getId() !== $v) {
			$this->aconversionProfile2 = null;
		}

		return $this;
	} // setConversionProfileId()

	/**
	 * Set the value of [flavor_params_id] column.
	 * 
	 * @param      int $v new value
	 * @return     flavorParamsConversionProfile The current object (for fluent API support)
	 */
	public function setFlavorParamsId($v)
	{
		if(!isset($this->oldColumnsValues[flavorParamsConversionProfilePeer::FLAVOR_PARAMS_ID]))
			$this->oldColumnsValues[flavorParamsConversionProfilePeer::FLAVOR_PARAMS_ID] = $this->flavor_params_id;

		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->flavor_params_id !== $v) {
			$this->flavor_params_id = $v;
			$this->modifiedColumns[] = flavorParamsConversionProfilePeer::FLAVOR_PARAMS_ID;
		}

		if ($this->aassetParams !== null && $this->aassetParams->getId() !== $v) {
			$this->aassetParams = null;
		}

		return $this;
	} // setFlavorParamsId()

	/**
	 * Set the value of [system_name] column.
	 * 
	 * @param      string $v new value
	 * @return     flavorParamsConversionProfile The current object (for fluent API support)
	 */
	public function setSystemName($v)
	{
		if(!isset($this->oldColumnsValues[flavorParamsConversionProfilePeer::SYSTEM_NAME]))
			$this->oldColumnsValues[flavorParamsConversionProfilePeer::SYSTEM_NAME] = $this->system_name;

		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->system_name !== $v) {
			$this->system_name = $v;
			$this->modifiedColumns[] = flavorParamsConversionProfilePeer::SYSTEM_NAME;
		}

		return $this;
	} // setSystemName()

	/**
	 * Set the value of [origin] column.
	 * 
	 * @param      int $v new value
	 * @return     flavorParamsConversionProfile The current object (for fluent API support)
	 */
	public function setOrigin($v)
	{
		if(!isset($this->oldColumnsValues[flavorParamsConversionProfilePeer::ORIGIN]))
			$this->oldColumnsValues[flavorParamsConversionProfilePeer::ORIGIN] = $this->origin;

		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->origin !== $v) {
			$this->origin = $v;
			$this->modifiedColumns[] = flavorParamsConversionProfilePeer::ORIGIN;
		}

		return $this;
	} // setOrigin()

	/**
	 * Set the value of [ready_behavior] column.
	 * 
	 * @param      int $v new value
	 * @return     flavorParamsConversionProfile The current object (for fluent API support)
	 */
	public function setReadyBehavior($v)
	{
		if(!isset($this->oldColumnsValues[flavorParamsConversionProfilePeer::READY_BEHAVIOR]))
			$this->oldColumnsValues[flavorParamsConversionProfilePeer::READY_BEHAVIOR] = $this->ready_behavior;

		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ready_behavior !== $v) {
			$this->ready_behavior = $v;
			$this->modifiedColumns[] = flavorParamsConversionProfilePeer::READY_BEHAVIOR;
		}

		return $this;
	} // setReadyBehavior()

	/**
	 * Set the value of [force_none_complied] column.
	 * 
	 * @param      boolean $v new value
	 * @return     flavorParamsConversionProfile The current object (for fluent API support)
	 */
	public function setForceNoneComplied($v)
	{
		if(!isset($this->oldColumnsValues[flavorParamsConversionProfilePeer::FORCE_NONE_COMPLIED]))
			$this->oldColumnsValues[flavorParamsConversionProfilePeer::FORCE_NONE_COMPLIED] = $this->force_none_complied;

		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->force_none_complied !== $v) {
			$this->force_none_complied = $v;
			$this->modifiedColumns[] = flavorParamsConversionProfilePeer::FORCE_NONE_COMPLIED;
		}

		return $this;
	} // setForceNoneComplied()

	/**
	 * Sets the value of [created_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     flavorParamsConversionProfile The current object (for fluent API support)
	 */
	public function setCreatedAt($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->created_at !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->created_at = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = flavorParamsConversionProfilePeer::CREATED_AT;
			}
		} // if either are not null

		return $this;
	} // setCreatedAt()

	/**
	 * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     flavorParamsConversionProfile The current object (for fluent API support)
	 */
	public function setUpdatedAt($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->updated_at !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->updated_at = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = flavorParamsConversionProfilePeer::UPDATED_AT;
			}
		} // if either are not null

		return $this;
	} // setUpdatedAt()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->conversion_profile_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->flavor_params_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->system_name = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->origin = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->ready_behavior = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->force_none_complied = ($row[$startcol + 6] !== null) ? (boolean) $row[$startcol + 6] : null;
			$this->created_at = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->updated_at = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 9; // 9 = flavorParamsConversionProfilePeer::NUM_COLUMNS - flavorParamsConversionProfilePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating flavorParamsConversionProfile object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

		if ($this->aconversionProfile2 !== null && $this->conversion_profile_id !== $this->aconversionProfile2->getId()) {
			$this->aconversionProfile2 = null;
		}
		if ($this->aassetParams !== null && $this->flavor_params_id !== $this->aassetParams->getId()) {
			$this->aassetParams = null;
		}
	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(flavorParamsConversionProfilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		flavorParamsConversionProfilePeer::setUseCriteriaFilter(false);
		$stmt = flavorParamsConversionProfilePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		flavorParamsConversionProfilePeer::setUseCriteriaFilter(true);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aconversionProfile2 = null;
			$this->aassetParams = null;
		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(flavorParamsConversionProfilePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				flavorParamsConversionProfilePeer::doDelete($this, $con);
				$this->postDelete($con);
				$this->setDeleted(true);
				$con->commit();
			} else {
				$con->commit();
			}
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(flavorParamsConversionProfilePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
			} else {
				$ret = $ret && $this->preUpdate($con);
			}
			if ($ret) {
				$affectedRows = $this->doSave($con);
				if ($isInsert) {
					$this->postInsert($con);
				} else {
					$this->postUpdate($con);
				}
				$this->postSave($con);
				flavorParamsConversionProfilePeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aconversionProfile2 !== null) {
				if ($this->aconversionProfile2->isModified() || $this->aconversionProfile2->isNew()) {
					$affectedRows += $this->aconversionProfile2->save($con);
				}
				$this->setconversionProfile2($this->aconversionProfile2);
			}

			if ($this->aassetParams !== null) {
				if ($this->aassetParams->isModified() || $this->aassetParams->isNew()) {
					$affectedRows += $this->aassetParams->save($con);
				}
				$this->setassetParams($this->aassetParams);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = flavorParamsConversionProfilePeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = flavorParamsConversionProfilePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += flavorParamsConversionProfilePeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Override in order to use the query cache.
	 * Cache invalidation keys are used to determine when cached queries are valid.
	 * Before returning a query result from the cache, the time of the cached query
	 * is compared to the time saved in the invalidation key.
	 * A cached query will only be used if it's newer than the matching invalidation key.
	 *  
	 * @return     array Array of keys that will should be updated when this object is modified.
	 */
	public function getCacheInvalidationKeys()
	{
		return array();
	}
		
	/**
	 * Code to be run before persisting the object
	 * @param PropelPDO $con
	 * @return bloolean
	 */
	public function preSave(PropelPDO $con = null)
	{
		return parent::preSave($con);
	}

	/**
	 * Code to be run after persisting the object
	 * @param PropelPDO $con
	 */
	public function postSave(PropelPDO $con = null) 
	{
		$this->oldColumnsValues = array(); 
	}
	
	/**
	 * Code to be run before inserting to database
	 * @param PropelPDO $con
	 * @return boolean
	 */
	public function preInsert(PropelPDO $con = null)
	{
    	$this->setCreatedAt(time());
    	
		$this->setUpdatedAt(time());
		return true;
	}
	
	/**
	 * Code to be run after inserting to database
	 * @param PropelPDO $con 
	 */
	public function postInsert(PropelPDO $con = null)
	{
		kQueryCache::invalidateQueryCache($this);
		
	}

	/**
	 * Code to be run after updating the object in database
	 * @param PropelPDO $con
	 */
	public function postUpdate(PropelPDO $con = null)
	{
		if ($this->alreadyInSave)
		{
			return;
		}
	
		kQueryCache::invalidateQueryCache($this);
		
	}
	
	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aconversionProfile2 !== null) {
				if (!$this->aconversionProfile2->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aconversionProfile2->getValidationFailures());
				}
			}

			if ($this->aassetParams !== null) {
				if (!$this->aassetParams->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aassetParams->getValidationFailures());
				}
			}


			if (($retval = flavorParamsConversionProfilePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = flavorParamsConversionProfilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getConversionProfileId();
				break;
			case 2:
				return $this->getFlavorParamsId();
				break;
			case 3:
				return $this->getSystemName();
				break;
			case 4:
				return $this->getOrigin();
				break;
			case 5:
				return $this->getReadyBehavior();
				break;
			case 6:
				return $this->getForceNoneComplied();
				break;
			case 7:
				return $this->getCreatedAt();
				break;
			case 8:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param      string $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                        BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. Defaults to BasePeer::TYPE_PHPNAME.
	 * @param      boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns.  Defaults to TRUE.
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = flavorParamsConversionProfilePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getConversionProfileId(),
			$keys[2] => $this->getFlavorParamsId(),
			$keys[3] => $this->getSystemName(),
			$keys[4] => $this->getOrigin(),
			$keys[5] => $this->getReadyBehavior(),
			$keys[6] => $this->getForceNoneComplied(),
			$keys[7] => $this->getCreatedAt(),
			$keys[8] => $this->getUpdatedAt(),
		);
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = flavorParamsConversionProfilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setConversionProfileId($value);
				break;
			case 2:
				$this->setFlavorParamsId($value);
				break;
			case 3:
				$this->setSystemName($value);
				break;
			case 4:
				$this->setOrigin($value);
				break;
			case 5:
				$this->setReadyBehavior($value);
				break;
			case 6:
				$this->setForceNoneComplied($value);
				break;
			case 7:
				$this->setCreatedAt($value);
				break;
			case 8:
				$this->setUpdatedAt($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = flavorParamsConversionProfilePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setConversionProfileId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFlavorParamsId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSystemName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setOrigin($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setReadyBehavior($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setForceNoneComplied($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCreatedAt($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setUpdatedAt($arr[$keys[8]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(flavorParamsConversionProfilePeer::DATABASE_NAME);

		if ($this->isColumnModified(flavorParamsConversionProfilePeer::ID)) $criteria->add(flavorParamsConversionProfilePeer::ID, $this->id);
		if ($this->isColumnModified(flavorParamsConversionProfilePeer::CONVERSION_PROFILE_ID)) $criteria->add(flavorParamsConversionProfilePeer::CONVERSION_PROFILE_ID, $this->conversion_profile_id);
		if ($this->isColumnModified(flavorParamsConversionProfilePeer::FLAVOR_PARAMS_ID)) $criteria->add(flavorParamsConversionProfilePeer::FLAVOR_PARAMS_ID, $this->flavor_params_id);
		if ($this->isColumnModified(flavorParamsConversionProfilePeer::SYSTEM_NAME)) $criteria->add(flavorParamsConversionProfilePeer::SYSTEM_NAME, $this->system_name);
		if ($this->isColumnModified(flavorParamsConversionProfilePeer::ORIGIN)) $criteria->add(flavorParamsConversionProfilePeer::ORIGIN, $this->origin);
		if ($this->isColumnModified(flavorParamsConversionProfilePeer::READY_BEHAVIOR)) $criteria->add(flavorParamsConversionProfilePeer::READY_BEHAVIOR, $this->ready_behavior);
		if ($this->isColumnModified(flavorParamsConversionProfilePeer::FORCE_NONE_COMPLIED)) $criteria->add(flavorParamsConversionProfilePeer::FORCE_NONE_COMPLIED, $this->force_none_complied);
		if ($this->isColumnModified(flavorParamsConversionProfilePeer::CREATED_AT)) $criteria->add(flavorParamsConversionProfilePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(flavorParamsConversionProfilePeer::UPDATED_AT)) $criteria->add(flavorParamsConversionProfilePeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(flavorParamsConversionProfilePeer::DATABASE_NAME);

		$criteria->add(flavorParamsConversionProfilePeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of flavorParamsConversionProfile (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setConversionProfileId($this->conversion_profile_id);

		$copyObj->setFlavorParamsId($this->flavor_params_id);

		$copyObj->setSystemName($this->system_name);

		$copyObj->setOrigin($this->origin);

		$copyObj->setReadyBehavior($this->ready_behavior);

		$copyObj->setForceNoneComplied($this->force_none_complied);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); // this is a auto-increment column, so set to default value

	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     flavorParamsConversionProfile Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		$copyObj->setCopiedFrom($this);
		return $copyObj;
	}
	
	/**
	 * Stores the source object that this object copied from 
	 *
	 * @var     flavorParamsConversionProfile Clone of current object.
	 */
	protected $copiedFrom = null;
	
	/**
	 * Stores the source object that this object copied from 
	 *
	 * @param      flavorParamsConversionProfile $copiedFrom Clone of current object.
	 */
	public function setCopiedFrom(flavorParamsConversionProfile $copiedFrom)
	{
		$this->copiedFrom = $copiedFrom;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     flavorParamsConversionProfilePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new flavorParamsConversionProfilePeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a conversionProfile2 object.
	 *
	 * @param      conversionProfile2 $v
	 * @return     flavorParamsConversionProfile The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setconversionProfile2(conversionProfile2 $v = null)
	{
		if ($v === null) {
			$this->setConversionProfileId(NULL);
		} else {
			$this->setConversionProfileId($v->getId());
		}

		$this->aconversionProfile2 = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the conversionProfile2 object, it will not be re-added.
		if ($v !== null) {
			$v->addflavorParamsConversionProfile($this);
		}

		return $this;
	}


	/**
	 * Get the associated conversionProfile2 object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     conversionProfile2 The associated conversionProfile2 object.
	 * @throws     PropelException
	 */
	public function getconversionProfile2(PropelPDO $con = null)
	{
		if ($this->aconversionProfile2 === null && ($this->conversion_profile_id !== null)) {
			$this->aconversionProfile2 = conversionProfile2Peer::retrieveByPk($this->conversion_profile_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aconversionProfile2->addflavorParamsConversionProfiles($this);
			 */
		}
		return $this->aconversionProfile2;
	}

	/**
	 * Declares an association between this object and a assetParams object.
	 *
	 * @param      assetParams $v
	 * @return     flavorParamsConversionProfile The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setassetParams(assetParams $v = null)
	{
		if ($v === null) {
			$this->setFlavorParamsId(NULL);
		} else {
			$this->setFlavorParamsId($v->getId());
		}

		$this->aassetParams = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the assetParams object, it will not be re-added.
		if ($v !== null) {
			$v->addflavorParamsConversionProfile($this);
		}

		return $this;
	}


	/**
	 * Get the associated assetParams object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     assetParams The associated assetParams object.
	 * @throws     PropelException
	 */
	public function getassetParams(PropelPDO $con = null)
	{
		if ($this->aassetParams === null && ($this->flavor_params_id !== null)) {
			$this->aassetParams = assetParamsPeer::retrieveByPk($this->flavor_params_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aassetParams->addflavorParamsConversionProfiles($this);
			 */
		}
		return $this->aassetParams;
	}

	/**
	 * Resets all collections of referencing foreign keys.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect objects
	 * with circular references.  This is currently necessary when using Propel in certain
	 * daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all associated objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} // if ($deep)

			$this->aconversionProfile2 = null;
			$this->aassetParams = null;
	}

} // BaseflavorParamsConversionProfile
