<?php

/**
 * Base abstraction for integer value, constant or calculated that retreived from the API 
 * @package Core
 * @subpackage model.data
 */
class kIntegerValue extends kValue
{
	/**
	 * @return int $value
	 */
	public function getValue() 
	{
		return $this->value;
	}

	/**
	 * @param int $value
	 */
	public function setValue($value) 
	{
		$this->value = $value;
	}
	
	/**
	 * @param accessControlScope $scope
	 * @return bool
	 */
	public function shouldDisableCache($scope)
	{
		return false;
	}
}