<?php
/**
 * @package plugins.marketing
 * @subpackage lib
 */
class kMarketingManager implements kObjectCreatedEventConsumer
{
	protected $_additionalParamsToMarketo = array(
		'Title',
		'Would_You_Like_to_Be_Contacted' => 'Would_You_Like_to_Be_Contacted__c',
		'Vertical' => 'Vertical__c_lead',
	);
	
	/* (non-PHPdoc)
	 * @see kObjectCreatedEventConsumer::shouldConsumeCreatedEvent()
	 */
	public function shouldConsumeCreatedEvent(BaseObject $object)
	{
		if ($object instanceof Partner)
			return true;
			
		return false;
	}
	
	/* (non-PHPdoc)
	 * @see kObjectCreatedEventConsumer::objectCreated()
	 */
	public function objectCreated(BaseObject $object) 
	{
		$this->syncPartnerWithLead($object);
		return true;
	}
	
	public function syncPartnerWithLead(Partner $partner)
	{
		$accessKey = kConf::get('marketo_access_key');
		$secretKey = kConf::get('marketo_secret_key');
		$soapEndPoint = 'https://na-g.marketo.com/soap/mktows/1_3';
		$marketo = new MarketoApiService($soapEndPoint.'?WSDL', array('location' => $soapEndPoint));
		$marketo->setCredentials($accessKey, $secretKey);
		
		$realDescription = '';
		$description = $partner->getDescription();
		if (substr_count($partner->getDescription(), 'KMC_SIGNUP|'))
		{
			$realDescription = str_replace('KMC_SIGNUP|', '', $partner->getDescription());
			$description = 'KMC_SIGNUP';
		}
		elseif (substr_count($partner->getDescription(), "\nWordpress all-in-one plugin"))
		{
			$str_index = strpos($partner->getDescription(), "\nWordpress all-in-one plugin");
			$description = str_replace("\n", '', substr($partner->getDescription(), $str_index));
			$realDescription = substr($partner->getDescription(), 0, $str_index);
		}
		
		$leadRecord = new LeadRecord();
		
		$leadRecord->Email = $partner->getAdminEmail();
		$leadRecord->leadAttributeList = new stdClass();
		
		$attributes = array();
		
		$attributes[] = $marketo->createAttribute('FirstName', $partner->getFirstName());
		$attributes[] = $marketo->createAttribute('LastName', $partner->getLastName());
		$attributes[] = $marketo->createAttribute('Kaltura_Partner_ID__c', $partner->getId());
		$attributes[] = $marketo->createAttribute('Company', $partner->getName());
		$attributes[] = $marketo->createAttribute('Kaltura_Partner_Activation_Type__c', $description);
		$attributes[] = $marketo->createAttribute('Kaltura_Content_Category__c', $partner->getContentCategories());
		$attributes[] = $marketo->createAttribute('Phone', $partner->getPhone());
		$attributes[] = $marketo->createAttribute('K_Description__c', $realDescription);
		$attributes[] = $marketo->createAttribute('Kaltura_Describe_Yourself__c', $partner->getDescribeYourself());
		$attributes[] = $marketo->createAttribute('Website', $partner->getUrl1());
		$attributes[] = $marketo->createAttribute('Country', $partner->getCountry());
		$attributes[] = $marketo->createAttribute('State', $partner->getState());
		
		// send the additional params
		$additionalParams = $partner->getAdditionalParams();

		$additionalParams = array_change_key_case($additionalParams); // lower case all keys
		foreach($this->_additionalParamsToMarketo as $kalturaKey => $marketoKey)
		{
			if (!is_string($kalturaKey))
				$kalturaKey = $marketoKey;
			$kalturaKey = strtolower($kalturaKey);
			
			if (isset($additionalParams[$kalturaKey]))
				$attributes[] = $marketo->createAttribute($marketoKey, $additionalParams[$kalturaKey]);
		}
		
		// check for form type
		$formType = isset($additionalParams['form_type']) ? $additionalParams['form_type'] : null;
		if ($formType == 'silverlight_signup')
			$attributes[] = $marketo->createAttribute('Form_Silverlight__c', 'True ' . date('r'));
		else
			$attributes[] = $marketo->createAttribute('Form_Hosted_Trial__c', 'True ' . date('r'));
		
		$leadRecord->leadAttributeList->attribute = $attributes;
		$params = new ParamsSyncLead();
		$params->leadRecord = $leadRecord;
		if (isset($additionalParams['marketo_cookie']))
			$params->marketoCookie =  $additionalParams['marketo_cookie'];
		
		try
		{
			$marketo->syncLead($params);
			KalturaLog::info('Lead for partner #' . $partner->getId() . ' was synced succesfully with Marketo');
		}
		catch(Exception $ex)
		{
			KalturaLog::err('Failed to sync lead for partner #' . $partner->getId());
			KalturaLog::err($ex);
		}
	}
}