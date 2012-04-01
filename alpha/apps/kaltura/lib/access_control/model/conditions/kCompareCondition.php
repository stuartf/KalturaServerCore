<?php
/**
 * @package Core
 * @subpackage model.data
 * @abstract
 */
abstract class kCompareCondition extends kCondition
{
	/**
	 * Value to evaluate against the field and operator
	 * @var kIntegerValue
	 */
	protected $value;
	
	/**
	 * Comparing operator, enum of searchConditionComparison
	 * @var int
	 */
	protected $comparison;

	/**
	 * @return kIntegerValue
	 */
	public function getValue() 
	{
		return $this->value;
	}

	/**
	 * Comparing operator, enum of searchConditionComparison
	 * @return int
	 */
	public function getComparison() 
	{
		return $this->comparison;
	}

	/**
	 * @param kIntegerValue $value
	 */
	public function setValue(kIntegerValue $value) 
	{
		$this->value = $value;
	}

	/**
	 * Comparing operator, enum of searchConditionComparison
	 * @param int $comparison
	 */
	public function setComparison($comparison) 
	{
		$this->comparison = $comparison;
	}

	/**
	 * Return single integer or array of integers
	 * @param accessControl $accessControl
	 * @return int|array<int> the field content
	 */
	abstract public function getFieldValue(accessControl $accessControl);
	
	/**
	 * @return int
	 */
	function getIntegerValue()
	{
		if(is_object($this->value))
			return $this->value->getValue();
		else
			return intval($this);
	}
	
	/**
	 * @param int $field
	 * @return bool
	 */
	protected function fieldFulfilled($field)
	{
		$value = $this->getIntegerValue();
		switch($this->comparison)
		{
			case searchConditionComparison::GREATER_THAN:
				KalturaLog::debug("Compares field[$field] > value[$value]");
				return ($field > $value);
				
			case searchConditionComparison::GREATER_THAN_OR_EQUEL:
				KalturaLog::debug("Compares field[$field] >= value[$value]");
				return ($field >= $value);
				
			case searchConditionComparison::LESS_THAN:
				KalturaLog::debug("Compares field[$field] < value[$value]");
				return ($field < $value);
				
			case searchConditionComparison::LESS_THAN_OR_EQUEL:
				KalturaLog::debug("Compares field[$field] <= value[$value]");
				return ($field <= $value);
				
			case searchConditionComparison::EQUEL:
			default:
				KalturaLog::debug("Compares field[$field] == value[$value]");
				return ($field == $value);
		}
	}
	
	/* (non-PHPdoc)
	 * @see kCondition::internalFulfilled()
	 */
	public function internalFulfilled(accessControl $accessControl)
	{
		$field = $this->getFieldValue($accessControl);
		$value = $this->getIntegerValue();
		
		KalturaLog::debug("Copares field [$field] to value [$value]");
		if (is_null($value))
		{
			KalturaLog::debug("Value is null, condition is true");
			return true;
		}
		
		if (!$field)
		{
			KalturaLog::debug("Field is empty, condition is false");
			return false;
		}

		if(is_array($field))
		{
			foreach($field as $fieldItem)
			{
				if(!$this->fieldFulfilled($fieldItem))
				{
					KalturaLog::debug("Field item [$fieldItem] does not fulfilled, condition is false");
					return false;
				}
			}
			KalturaLog::debug("All field items fulfilled, condition is true");
			return true;
		}
		
		return $this->fieldFulfilled($field);
	}
}
