<?php

/**
 * Returns the current request user agent 
 * @package Core
 * @subpackage model.data
 */
class kUserAgentContextField extends kStringField
{
	/* (non-PHPdoc)
	 * @see kStringField::getFieldValue()
	 */
	protected function getFieldValue(accessControlScope $scope = null) 
	{
		kApiCache::addExtraField(kApiCache::ECF_USER_AGENT);

		if(!$scope)
			$scope = new accessControlScope();
		
		return $scope->getUserAgent();
	}

	/* (non-PHPdoc)
	 * @see kStringValue::shouldDisableCache()
	 */
	public function shouldDisableCache($scope)
	{
		return false;
	}
}
