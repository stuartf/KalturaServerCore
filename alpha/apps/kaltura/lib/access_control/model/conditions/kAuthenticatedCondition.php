<?php
/**
 * @package Core
 * @subpackage model.data
 */
class kAuthenticatedCondition extends kCondition
{
	/* (non-PHPdoc)
	 * @see kCondition::__construct()
	 */
	public function __construct($not = false)
	{
		$this->setType(ConditionType::AUTHENTICATED);
		parent::__construct($not);
	}
	
	/**
	 * The privelege needed to remove the restriction
	 * 
	 * @var array
	 */
	protected $privileges = array(ks::PRIVILEGE_VIEW, ks::PRIVILEGE_VIEW_ENTRY_OF_PLAYLIST);
	
	/**
	 * @param array $privileges
	 */
	public function setPrivileges(array $privileges)
	{
		$this->privileges = $privileges;
	}
	
	/**
	 * @return array
	 */
	function getPrivileges()
	{
		return $this->privileges;
	}
	
	/* (non-PHPdoc)
	 * @see kCondition::fulfilled()
	 */
	public function fulfilled(accessControl $accessControl)
	{
		$scope = $accessControl->getScope();
		if (!$scope->getKs() || (!$scope->getKs() instanceof ks))
			return $this->calcNot(false);
		
		if ($scope->getKs()->isAdmin())
			return $this->calcNot(true);
		
		$privilegeVerified = true;
		foreach($this->privileges as $privilege)
			$privilegeVerified = $privilegeVerified && $this->calcNot($scope->getKs()->verifyPrivileges($privilege, $scope->getEntryId()));

		return $privilegeVerified;
	}
}
