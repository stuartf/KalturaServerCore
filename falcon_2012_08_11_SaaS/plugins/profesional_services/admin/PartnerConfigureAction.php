<?php
class PartnerConfigureAction extends KalturaAdminConsolePlugin
{
	public function __construct()
	{
		$this->action = 'configureNoneCommercial';
	}
	
	/**
	 * @return string - absolute file path of the phtml template
	 */
	public function getTemplatePath()
	{
		return realpath(dirname(__FILE__));
	}
	
	public function getRequiredPermissions()
	{
		return array(KalturaPermissionName::SYSTEM_ADMIN_PUBLISHER_BASE);
	}
		
	public function doAction(Zend_Controller_Action $action)
	{
		$action->getHelper('layout')->disableLayout();
		$partnerId = $this->_getParam('partner_id');
		$client = Kaltura_ClientHelper::getClient();
		$form = new Form_ProfesionalServicesPartnerConfiguration();
		Form_PackageHelper::addPackagesToForm($form, $client->systemPartner->getPackages());
		
		
		$moduls = Zend_Registry::get('config')->moduls;
		if ($moduls)
		{
			if (!$moduls->silverLight)
				$form->getElement('enable_silver_light')->setAttrib('disabled',true);
				
			if (!$moduls->liveStream)
				$form->getElement('live_stream_enabled')->setAttrib('disabled',true);
				
			if (!$moduls->vast)
				$form->getElement('enable_vast')->setAttrib('disabled',true);
				
			if (!$moduls->players508)
				$form->getElement('enable_508_players')->setAttrib('disabled',true);
				
			if (!$moduls->metadata)
				$form->getElement('enable_metadata')->setAttrib('disabled',true);
				
			if (!$moduls->auditTrail)
				$form->getElement('enable_audit_trail')->setAttrib('disabled',true);
		}
		
		$request = $action->getRequest();
		
		if ($request->isPost())
		{
			$form->populate($request->getPost());
			$config = $form->getObject("KalturaSystemPartnerConfiguration", $request->getPost());
			$client->systemPartner->updateConfiguration($partnerId, $config);
		}
		else
		{
			$client->startMultiRequest();
			$client->systemPartner->get($partnerId);
			$client->systemPartner->getConfiguration($partnerId);
			$result = $client->doMultiRequest();
			$partner = $result[0];
			$config = $result[1];
			$form->populateFromObject($config);
		}
		
		$action->view->form = $form;
	}
}

