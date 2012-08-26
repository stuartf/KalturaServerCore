<?php
/**
 * Kaltura Sharepoint Extension Service
 *
 * @service sharepointExtension
 * @package plugins.sharepointExtension
 * @subpackage api.services
 */
class KalturaSharepointExtensionService extends KalturaBaseService
{
	
	public function initService($serviceId, $serviceName, $actionName)
	{
		parent::initService($serviceId, $serviceName, $actionName);

		if(!KalturaSharepointExtensionPlugin::isAllowedPartner($this->getPartnerId()))
			throw new KalturaAPIException(KalturaErrors::SERVICE_FORBIDDEN, $this->serviceName.'->'.$this->actionName);
	}
    	/**
	 * Is this Kaltura-Sharepoint-Server-Plugin supports minimum version of $major.$minor.$build (which is required by the extension)
	 *
	 * @action isVersionSupported
	 * @param int $serverMajor
	 * @param int $serverMinor
	 * @param int $serverBuild
	 * @return bool
	 *
	 */
	static public function isVersionSupported($serverMajor, $serverMinor, $serverBuild)
	{
                $version = new KalturaVersion($serverMajor, $serverMinor, $serverBuild);
                $pluginVersion = KalturaSharepointExtensionPlugin::getVersion();
                
                $result = true;
                if(!$pluginVersion->isCompatible($version))
                {
                    $result = false;
                }
		
		return $result;
	}
        
        /**
	 * list uiconfs for sharepoint extension
	 *
	 * @action listUiconfs
	 * @return KalturaUiConfListResponse
	 *
	 * @throw KalturaSharepointExtensionErrors::NOT_SUPPORTED_MISSING_UICONFS
	 */
	public function listUiconfs()
	{
                $pluginVersion = KalturaSharepointExtensionPlugin::getVersion();
                $uiConfTags = 'autodeploy, sharepoint_v'.$pluginVersion->toString().'%';

                $c = new Criteria();
                $c->addAnd(uiConfPeer::TAGS, $uiConfTags, Criteria::LIKE);
                $c->addAnd(uiConfPeer::DISPLAY_IN_SEARCH, mySearchUtils::DISPLAY_IN_SEARCH_KALTURA_NETWORK);
                if($this->getPartnerId())
                {
                        $c->addAnd(uiConfPeer::PARTNER_ID, array(0, $this->getPartnerId()), Criteria::IN);
                }
                else
                {
                        $c->addAnd(uiConfPeer::PARTNER_ID, 0);
                }

                $count = uiConfPeer::doCount( $c );
                if(!$count)
                {
                    throw new KalturaAPIException(KalturaSharepointExtensionErrors::NOT_SUPPORTED_MISSING_UICONFS);
                }
                
                $uiconfs = uiConfPeer::doSelect( $c );
                
                $newList = KalturaUiConfArray::fromUiConfArray( $uiconfs );
                $response = new KalturaUiConfListResponse();
                $response->objects = $newList;
                $response->totalCount = $count;
		
		return $response;
	}
}
