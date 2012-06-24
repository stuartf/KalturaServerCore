<?php

/**
 * Base abstraction for realtime calculated integer value 
 * @package Core
 * @subpackage model.data
 */
abstract class kIntegerField extends kIntegerValue
{
	/**
	 * @var accessControlScope
	 */
	protected $scope = null;
	
	/**
	 * Calculates the value at realtime
	 * @param accessControlScope $scope
	 * @return int $value
	 */
	abstract protected function getFieldValue(accessControlScope $scope = null);
	
	/* (non-PHPdoc)
	 * @see kIntegerValue::getValue()
	 */
	public function getValue() 
	{
		return $this->getFieldValue($this->scope);
	}
	
	/**
	 * @param accessControlScope $scope
	 */
	public function setScope(accessControlScope $scope) 
	{
		$this->scope = $scope;
	}

	/* (non-PHPdoc)
	 * @see kIntegerValue::shouldDisableCache()
	 */
	public function shouldDisableCache($scope)
	{
		return true;
	}
}