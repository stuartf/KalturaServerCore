<?php

/**
 * Subclass for representing a row from the 'access_control' table.
 *
 * 
 *
 * @package Core
 * @subpackage model
 */ 
class accessControl extends BaseaccessControl
{
	/**
	 * True when set as partner default (saved on partner object)
	 * 
	 * @var bool
	 */
	protected $isDefault;
	
	/**
	 * @var accessControlScope
	 */
	protected $scope;
	
	
	const IP_ADDRESS_RESTRICTION_COLUMN_NAME = 'ip_address_restriction';
	const USER_AGENT_RESTRICTION_COLUMN_NAME = 'user_agent_restriction';

	/* (non-PHPdoc)
	 * @see BaseaccessControl::preSave()
	 */
	public function preSave(PropelPDO $con = null)
	{
		if ($this->isColumnModified(accessControlPeer::DELETED_AT))
		{
			if ($this->isDefault === true)
				throw new kCoreException("Default access control profile [" . $this->getId(). "] can't be deleted", kCoreException::ACCESS_CONTROL_CANNOT_DELETE_PARTNER_DEFAULT);
				
			$c = new Criteria();
			$c->add(entryPeer::ACCESS_CONTROL_ID, $this->getId());
			$entryCount = entryPeer::doCount($c);
			if ($entryCount > 0)
				throw new kCoreException("Default access control profile [" . $this->getId(). "] is linked with [$entryCount] entries and can't be deleted", kCoreException::ACCESS_CONTROL_CANNOT_DELETE_USED_PROFILE);
		}
		
		return parent::preSave($con);
	}

	/* (non-PHPdoc)
	 * @see BaseaccessControl::preInsert()
	 */
	public function preInsert(PropelPDO $con = null)
	{
		$c = new Criteria();
		$c->add(accessControlPeer::PARTNER_ID, $this->getPartnerId());
		$count = accessControlPeer::doCount($c);
		
		$partner = PartnerPeer::retrieveByPK($this->getPartnerId());
		$maxAccessControls = $partner->getAccessControls();
		if ($count >= $maxAccessControls)
			throw new kCoreException("Max number of access control profiles [$maxAccessControls] was reached", kCoreException::MAX_NUMBER_OF_ACCESS_CONTROLS_REACHED, $maxAccessControls);
		
		return parent::preInsert($con);
	}
	
	/* (non-PHPdoc)
	 * @see lib/model/om/BaseaccessControl#postUpdate()
	 */
	public function postSave(PropelPDO $con = null)
	{
		// set this profile as partners default
		$partner = PartnerPeer::retrieveByPK($this->getPartnerId());
		if ($partner && $this->isDefault === true)
		{
			$partner->setDefaultAccessControlId($this->getId());
			$partner->save();
		}
		
		parent::postSave($con);
	}

	/* (non-PHPdoc)
	 * @see lib/model/om/BaseaccessControl#postUpdate()
	 */
	public function postUpdate(PropelPDO $con = null)
	{
		if ($this->alreadyInSave)
			return parent::postUpdate($con);
		
		$objectDeleted = false;
		if($this->isColumnModified(accessControlPeer::DELETED_AT) && !is_null($this->getDeletedAt()))
			$objectDeleted = true;
			
		$ret = parent::postUpdate($con);
		
		if($objectDeleted)
			kEventsManager::raiseEvent(new kObjectDeletedEvent($this));
			
		return $ret;
	}
	
	/* (non-PHPdoc)
	 * @see BaseaccessControl::copyInto()
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{
		/* @var $copyObj accessControl */
		parent::copyInto($copyObj, $deepCopy);
		$copyObj->setIsDefault($this->getIsDefault());
	}
	
	/**
	 * Set the accessControlScope, called internally only
	 * 
	 * @param $scope
	 */
	protected function setScope(accessControlScope $scope)
	{
		$this->scope = $scope;
	}
	
	/**
	 * Get the accessControlScope
	 * 
	 * @return accessControlScope
	 */
	public function &getScope()
	{
		if (!$this->scope)
			$this->scope = new accessControlScope();
			
		return $this->scope;
	}
	
	/**
	 * Check if there are any rules in this accessControl object
	 * 
	 * @return boolean
	 */
	public function hasRules()
	{
		return count($this->getRulesArray()) ? true : false;
	}
	
	/**
	 * @param kEntryContextDataResult $context
	 * @param accessControlScope $scope
	 * @return boolean disable cache or not
	 */
	public function applyContext(kEntryContextDataResult &$context, accessControlScope $scope = null)
	{
		if($scope)
			$this->setScope($scope);
		$scope = $this->getScope();
		
		if ($scope->getKs() && ($scope->getKs() instanceof ks) && $scope->getKs()->isAdmin())
			return true;
		
		$disableCache = true;
		
		$rules = $this->getRulesArray();
		foreach($rules as $rule)
		{
			/* @var $rule kRule */
			$fulfilled = $rule->applyContext($context);
				 
			if(!$rule->shouldDisableCache())
				$disableCache = false;
				
			if($fulfilled && $rule->getStopProcessing())
				break;
		}
			
		return $disableCache;
	}
	
	/**
	 * Validate all rules
	 *
	 * @param accessControlScope $scope
	 * @return bool	
	 */
	public function isValid(accessControlScope $scope = null)
	{
		$context = new kEntryContextDataResult();
		$this->applyContext($context, $scope);
		return (count($context->getAccessControlActions()) == 0);
	}
	
	/**
	 * @param array<kRule> $rules
	 */
	public function setRulesArray(array $rules)
	{
		$this->setRules(serialize($rules));
	}
	
	/**
	 * @return array<kRule>
	 */
	public function getRulesArray()
	{
		$rules = array();
		$rulesString = $this->getRules();
		if($rulesString)
		{
			try
			{
				$rules = unserialize($rulesString);
			}
			catch(Exception $e)
			{
				KalturaLog::err("Unable to unserialize [$rulesString], " . $e->getMessage());
				$rules = array();
			}
		} 
		
		// TODO - remove after full migration
		if(!count($rules))
		{
			if (!is_null($this->getSiteRestrictType()))
				$rules[] = new kAccessControlSiteRestriction($this);
				
			if (!is_null($this->getCountryRestrictType()))
				$rules[] = new kAccessControlCountryRestriction($this);
				
			if (!is_null($this->getKsRestrictPrivilege()))
				$rules[] = new kAccessControlSessionRestriction($this);
				
			if (!is_null($this->getPrvRestrictPrivilege()))
				$rules[] = new kAccessControlPreviewRestriction($this);
				
			if (!is_null($this->getFromCustomData(self::IP_ADDRESS_RESTRICTION_COLUMN_NAME)))
				$rules[] = new kAccessControlIpAddressRestriction($this);
				
			if (!is_null($this->getFromCustomData(self::USER_AGENT_RESTRICTION_COLUMN_NAME)))
				$rules[] = new kAccessControlUserAgentRestriction($this);
		}
		
		foreach ($rules as &$rule)
			$rule->setAccessControl($this);
			
		return $rules;
	}
	
	/**
	 * @param bool $v
	 */
	public function setIsDefault($v)
	{
		$this->isDefault = (bool)$v;
	}
	
	/**
	 * @return boolean
	 */
	public function getIsDefault()
	{
		if ($this->isDefault === null)
		{
			if ($this->isNew())
				return false;
				
			$partner = PartnerPeer::retrieveByPK($this->partner_id);
			if ($partner && ($this->getId() == $partner->getDefaultAccessControlId()))
				$this->isDefault = true;
			else
				$this->isDefault = false;
		}
		
		return $this->isDefault;
	}
	
	public function getCacheInvalidationKeys()
	{
		return array("accessControl:id=".$this->getId());
	}
}
