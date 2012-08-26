<?php
class ProfesionalServicesPlugin extends KalturaPlugin implements IKalturaAdminConsolePages
{
	const PLUGIN_NAME = 'ProfesionalServices';
	
	public static function getPluginName()
	{
		return self::PLUGIN_NAME;
	}
	
	public static function getAdminConsolePages()
	{
		$partnersList = new PartnerListAction();
		$partnersConfigure = new PartnerConfigureAction();
		return array($partnersList, $partnersConfigure);
	}
}