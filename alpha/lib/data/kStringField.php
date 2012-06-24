<?php

/**
 * Base abstraction for realtime calculated string value 
 * @package Core
 * @subpackage model.data
 */
abstract class kStringField extends kStringValue
{
	/**
	 * @var accessControlScope
	 */
	protected $scope = null;
	
	/**
	 * Calculates the value at realtime
	 * @param accessControlScope $scope
	 * @return string $value
	 */
	abstract protected function getFieldValue(accessControlScope $scope = null);
	
	/* (non-PHPdoc)
	 * @see kStringValue::getValue()
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
	 * @see kStringValue::shouldDisableCache()
	 */
	public function shouldDisableCache($scope)
	{
		return true;
	}
}