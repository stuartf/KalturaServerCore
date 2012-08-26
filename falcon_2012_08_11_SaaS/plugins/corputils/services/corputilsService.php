<?php

/**
 * Corputils service
 *
 * @service corputils
 */
class CorputilsService extends KalturaBaseService
{
	public function initService($partnerId, $puserId, $ksStr, $serviceName, $action)
	{
		parent::initService($partnerId, $puserId, $ksStr, $serviceName, $action);

		// since plugin might be using KS impersonation, we need to validate the requesting
		// partnerId from the KS and not with the $_POST one
		if(!corputilsPlugin::isAllowedPartner(kCurrentContext::$ks_partner_id))
			throw new KalturaAPIException(KalturaErrors::SERVICE_FORBIDDEN);
		
	}
	
	/**
	 * @action adSupportOptIn
	 * @param int $partner_id
	 * @param string $emailHashString
	 * @return string
	 */
	public function adSupportOptInAction($partner_id, $emailHashString)
	{
		KalturaLog::info("adSupportOptIn: start");
		$partner = PartnerPeer::retrieveByPK($partner_id);
		if(!$partner)
			throw new KalturaAPIException(KalturaErrors::UNKNOWN_PARTNER_ID, $partner_id);

		// TODO - validate authenticity by hash
		$hash = myPartnerUtils::getEmailLinkHash($partner->getId(), $partner->getSecret());
		if($hash != $emailHashString)
			throw new KalturaAPIException(KalturaErrors::PARTNER_ACCESS_FORBIDDEN);
		
		$partner->setMonitorUsage(PartnerFreeTrialType::NO_LIMIT);
		$partner->setAdSupported(1);
		
		$partner->save();
		KalturaLog::info("adSupportOptIn: finish ok");
		return 'ok';
	}
}
