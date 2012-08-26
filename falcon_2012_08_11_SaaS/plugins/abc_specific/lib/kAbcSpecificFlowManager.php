<?php
/**
 * @package plugins.abcSpecific
 * @subpackage lib
 */
class kAbcSpecificFlowManager implements kObjectDataChangedEventConsumer, kObjectChangedEventConsumer
{   
    
    const CUSTOM_DATA_ENTRY_MIN_SUNRISE_FIELD = 'minSunriseField';
    const CUSTOM_DATA_ENTRY_MAX_SUNSET_FIELD = 'maxSunsetField';
					
    
	/* (non-PHPdoc)
	 * @see kObjectDataChangedEventConsumer::shouldConsumeDataChangedEvent()
	 */
	public function shouldConsumeDataChangedEvent(BaseObject $object, $previousVersion = null)
	{
		if(class_exists('Metadata') && $object instanceof Metadata && $object->getObjectType() == MetadataObjectType::ENTRY) {
			return true;
		}
			
		return false;
	}

	/* (non-PHPdoc)
	 * @see kObjectDataChangedEventConsumer::objectDataChanged()
	 */
	public function objectDataChanged(BaseObject $object, $previousVersion = null, BatchJob $raisedJob = null)
	{
		if(class_exists('Metadata') && $object instanceof Metadata && $object->getObjectType() == MetadataObjectType::ENTRY) {
			return self::onMetadataChanged($object, $previousVersion);
		}
			
		return true;
	}
	
	
	/**
	 * @param BaseObject $object
	 * @param array $modifiedColumns
	 * @return bool true if the consumer should handle the event
	 */
	public function shouldConsumeChangedEvent(BaseObject $object, array $modifiedColumns)
	{
		if($object instanceof entry) {
			return true;
		}
		
		return false;		
	}
	
	
	/**
	 * @param BaseObject $object
	 * @param array $modifiedColumns
	 * @return bool true if should continue to the next consumer
	 */
	public function objectChanged(BaseObject $object, array $modifiedColumns)
	{
		if($object instanceof entry) {
			return self::onEntryChanged($object, $modifiedColumns);
		}
		
		return true;
	}
	
	
	/**
	 * @param Metadata $metadata
	 */
	public static function onMetadataChanged(Metadata $metadata, $previousVersion)
	{
		if(!AbcSpecificPlugin::isAllowedPartner($metadata->getPartnerId()))
			return true;
			
		if($metadata->getObjectType() != KalturaMetadataObjectType::ENTRY)
			return true;
		
		KalturaLog::log('Metadata id [' . $metadata->getId() . '] changed for entry [' . $metadata->getObjectId() . ']');
		
        $syncKey = $metadata->getSyncKey(Metadata::FILE_SYNC_METADATA_DATA);
		$xmlPath = kFileSyncUtils::getLocalFilePathForKey($syncKey);
		if(!$xmlPath)
		{
			KalturaLog::log("Entry metadata xml not found");
			return true;
		}
		$xml = new DOMDocument();
		$xml->load($xmlPath);
		
		// update scheduling parameters
        self::updateSchedulingFields($metadata->getObjectId(), $metadata->getPartnerId(), $xml);
		
		// update MRM ID
        $updatedXmlStr = self::updateMrmIdFieldValue($xml, $metadata);
        if (!is_null($updatedXmlStr)) {
            $saved = self::saveXml($xmlPath, $updatedXmlStr);
        }
        
        // update KALTURA ID
        $xml = new DOMDocument();
		$xml->load($xmlPath);
	    $updatedXmlStr = self::updateKalturaIdFieldValue($xml, $metadata);
        if (!is_null($updatedXmlStr)) {
            $saved = self::saveXml($xmlPath, $updatedXmlStr);
        }
        
        // IMPORTANT! - for future additions - make sure to re-init the $xml object with the new XML content
        
        return true;
	}
	
	
	/**
	 * @param entry $entry
	 * @param array $modifiedColumns
	 */
	public static function onEntryChanged(entry $entry, array $modifiedColumns)
	{
	    if(!AbcSpecificPlugin::isAllowedPartner($entry->getPartnerId()))
			return true;
		
		// update scheduling parameters
	    if (in_array(entryPeer::START_DATE, $modifiedColumns) || in_array(entryPeer::END_DATE, $modifiedColumns))
	    {
	        $minSunrise = self::getMinSunrise($entry);
	        $maxSunset = self::getMaxSunset($entry);
	        
	        if ($entry->getStartDate(null) != $minSunrise || $entry->getEndDate(null) != $maxSunset)
	        {
	            $entry->setStartDate($minSunrise);
	            $entry->setEndDate($maxSunset);
	            $entry->save();
	        }
	    }
			
		return true;			
	}
			
	
	protected static function findMetadataProfileIdWithField($fieldKey, $partnerId)
	{
	    $c = new Criteria();
	    $c->addAnd(MetadataProfileFieldPeer::PARTNER_ID, $partnerId, Criteria::EQUAL);
	    $c->addAnd(MetadataProfileFieldPeer::KEY, $fieldKey, Criteria::EQUAL);
	    $c->addAnd(MetadataProfileFieldPeer::STATUS, MetadataProfileField::STATUS_DEPRECATED, Criteria::NOT_EQUAL);
	    $metadataField = MetadataProfileFieldPeer::doSelectOne($c);
	    if ($metadataField) {
	        return $metadataField->getMetadataProfileId();
	    }
	    return null;
	}
	
	
	protected static function getValueForKey(DOMDocument $xml, $fieldKey)
	{
		$result = array();
	    $elements = $xml->getElementsByTagName($fieldKey);
	    if (is_null($elements) || $elements->length == 0) {
	        $result = null;
	    }
	    else
	    {
	        foreach ($elements as $element)
	        {
	            $result[] = $element->textContent;
	        }
	    }

	    if (count($result) == 1) {
	        $result = $result[0];
	    }

        return $result;
	}
	
	
	protected static function saveXml($xmlPath, $newXmlContents)
	{
		// test if the new xml string can be loaded
		$newXmlOk = false;
		$testXml = new DOMDocument();
		try {
		    $newXmlOk = $testXml->loadXML($newXmlContents);
		}
		catch (Exception $e) {
		    $newXmlOk = false;
		}
		
		if ($newXmlOk) {
		    // save new file
		    KalturaLog::log('Saving new metadata XML file');
		    $success = file_put_contents($xmlPath, $newXmlContents);
		    return ($success > 0);
		}
		else {
		    // error occured - don't change the file
		    KalturaLog::err('Cannot update metadata XML due to problems loading the modified XML - '.$newXmlContents);
		    return false;
		}
	}

	
	protected static function updateMrmIdFieldValue(DOMDocument $xml, Metadata $metadata)
	{		
		// if current mrm id value is empty -> do nothing and quit
		$currentMrmIdValue = self::getValueForKey($xml, AbcSpecificConfig::MRM_ID);
		if (is_null($currentMrmIdValue))
		{
		    KalturaLog::log('Current metadata does not contain any value for key ['.AbcSpecificConfig::MRM_ID.'] - skipping');
		    return null;
		}
		
		$newMrmIdValue = null;
		
		// search for type "clip"
		$objectSubType = self::getValueForKey($xml, AbcSpecificConfig::OBJECT_SUB_TYPE);
		$clipSubtypes = explode(',', AbcSpecificConfig::CLIP_OBJECT_SUB_TYPES);
		if (in_array($objectSubType, $clipSubtypes))
		{
		    $newMrmIdValue = 'CL:'.$metadata->getObjectId();
		}
		
		// search for type "movie"
		if (is_null($newMrmIdValue))
		{
		    $tmsId = self::getValueForKey($xml, AbcSpecificConfig::TMS_ID);
		    $showType = self::getValueForKey($xml, AbcSpecificConfig::SHOW_TYPE);
		    if (strpos($tmsId, 'MV') === 0 || $showType == AbcSpecificConfig::MOVIE_SHOW_TYPE) {
		        $newMrmIdValue = 'MV:'.$tmsId;
		    }
		}
		
		// search for type "movie/special" according to show entry's name
		if (is_null($newMrmIdValue))
		{
		    $showEntryIds = self::getValueForKey($xml, AbcSpecificConfig::SHOWS);
		    if (!is_null($showEntryIds))
		    {
    		    if (!is_array($showEntryIds)) {
    		        $showEntryIds = array($showEntryIds);
    		    }
    		    $movieShowNames = explode(',', AbcSpecificConfig::MOVIE_SHOW_NAMES);
    		    $specialShowNames = explode(',', AbcSpecificConfig::SPECIAL_SHOW_NAMES);
    		    foreach ($showEntryIds as $entryId)
    		    {
    		        $entry = entryPeer::retrieveByPK($entryId);
    		        if ($entry)
    		        {
        		        $entryName = $entry->getName();
        		        if (in_array($entryName, $movieShowNames)) {
        		            $newMrmIdValue = 'MV:'.$tmsId;
        		            break; // if found to be a movie -> should stop searching
        		        }
        		        else if (in_array($entryName, $specialShowNames)) {
        		            $vwid = self::getValueForKey($xml, AbcSpecificConfig::VIDEO_WORFLOW_ID);
        		            $newMrmIdValue = 'SP:'.$vwid; // if found to be special -> should still search if is a movie
        		        }
    		        }
    		    }
		    }
		}
		
		// otherwise - type is "episode"
	    if (is_null($newMrmIdValue))
		{
		    $showAdTarget = self::getValueForKey($xml, AbcSpecificConfig::SHOW_AD_TARGET);
		    $season = self::getValueForKey($xml, AbcSpecificConfig::SEASON);
		    $episodeSequenceNumber = self::getValueForKey($xml, AbcSpecificConfig::EPISODE_SEQUENCE_NUMBER);
		    $part = self::getValueForKey($xml, AbcSpecificConfig::PART);
		    $version = self::getValueForKey($xml, AbcSpecificConfig::VERSION);
		    
		    $newMrmIdValue = "EP:$showAdTarget:$season:$episodeSequenceNumber:$part:$version";
		}
		
		// replace the old MRMID value with the new value
		$newMrmIdValueXml = '<'.AbcSpecificConfig::MRM_ID.'>'.$newMrmIdValue.'</'.AbcSpecificConfig::MRM_ID.'>';
		$syncKey = $metadata->getSyncKey(Metadata::FILE_SYNC_METADATA_DATA);
		$xmlPath = kFileSyncUtils::getLocalFilePathForKey($syncKey);
		$oldXmlContents = file_get_contents($xmlPath);
		$newXmlContents = preg_replace('/<'.AbcSpecificConfig::MRM_ID.'>.*<\/'.AbcSpecificConfig::MRM_ID.'>/', $newMrmIdValueXml, $oldXmlContents);

		return $newXmlContents;
	}
	
	
	protected static function updateKalturaIdFieldValue(DOMDocument $xml, Metadata $metadata)
	{	
	    // if current kaltura id value is empty -> do nothing and quit
		$currentKalturaIdValue = self::getValueForKey($xml, AbcSpecificConfig::KALTURA_ID);
		if (is_null($currentKalturaIdValue))
		{
		    KalturaLog::log('Current metadata does not contain any value for key ['.AbcSpecificConfig::KALTURA_ID.'] - skipping');
		    return null;
		}
		
		// get entry object
		$entryId = $metadata->getObjectId();
		$entry = entryPeer::retrieveByPK($entryId);
		if (!$entry)
		{
		    KalturaLog::log('Cannot find entry with id ['.$entryId.'] - skipping');
		    return null;
		}
		
		$contentTypeCode = null;
		
		$entryType = $entry->getType();
		switch ($entryType)
		{
		    case entryType::PLAYLIST:
		        $contentTypeCode = 'PL';
		        break;
		        
		    case entryType::MEDIA_CLIP:
		        
		        $entryMediaType = $entry->getMediaType();
		        switch ($entryMediaType)
		        {
		            case entry::ENTRY_MEDIA_TYPE_VIDEO:
        		        $contentTypeCode = 'VD';
        		        break;
        		        
        		     case entry::ENTRY_MEDIA_TYPE_AUDIO:
        		        $contentTypeCode = 'AU';
        		        break;
        		        
        		      case entry::ENTRY_MEDIA_TYPE_IMAGE:
        		        $objectType = self::getValueForKey($xml, AbcSpecificConfig::OBJECT_TYPE);
        		        if ($objectType == AbcSpecificConfig::OBJECT_TYPE_SERIES)
        		        {
        		            $contentTypeCode = 'SH';
        		        }
        		        else if (is_null($objectType) || strlen($objectType) == 0)
        		        {
        		            $contentTypeCode = 'IM';
        		        }
        		        break;		            
		        }
		        
		        break;
		}
			
		$newXmlContents = null;
		$newKalturaIdValue = '';		
		if ($contentTypeCode)
		{
		    $newKalturaIdValue = $contentTypeCode.'KA'.$entryId;
		}
		
	    // generate new kaltura id
	    if ($newKalturaIdValue != $currentKalturaIdValue)
	    {
		    // replace the old id with the new one
		    $newKalturaIdValueXml = '<'.AbcSpecificConfig::KALTURA_ID.'>'.$newKalturaIdValue.'</'.AbcSpecificConfig::KALTURA_ID.'>';
		    $syncKey = $metadata->getSyncKey(Metadata::FILE_SYNC_METADATA_DATA);
    		$xmlPath = kFileSyncUtils::getLocalFilePathForKey($syncKey);
    		$oldXmlContents = file_get_contents($xmlPath);
    		$newXmlContents = preg_replace('/<'.AbcSpecificConfig::KALTURA_ID.'>.*<\/'.AbcSpecificConfig::KALTURA_ID.'>/', $newKalturaIdValueXml, $oldXmlContents);
	    }		    
		
		return $newXmlContents;	    
	}
	
	
	protected static function updateSchedulingFields($entryId, $partnerId, DOMDocument $xml)
	{        
	    $sunriseFields = explode(',', AbcSpecificConfig::SUNRISE_FIELDS);
	    $sunsetFields = explode(',', AbcSpecificConfig::SUNSET_FIELDS);
	    	    
	    // calculate minimum sunrise
	    $minSunrise = null;
	    foreach ($sunriseFields as $fieldKey)
	    {
	        $fieldValue = self::getValueForKey($xml, $fieldKey);
	        if (is_numeric($fieldValue))
	        {
    	        if (is_null($minSunrise) || (intval($fieldValue) < $minSunrise)) {
    	            $minSunrise = intval($fieldValue);
    	        }
	        }	        
	    }
	    
	    // calculate maximum sunset
	    $maxSunset = null;
	    foreach ($sunsetFields as $fieldKey)
	    {
	        $fieldValue = self::getValueForKey($xml, $fieldKey);
	        if (is_numeric($fieldValue))
	        {
    	        if (is_null($maxSunset) || (intval($fieldValue) > $maxSunset)) {
    	            $maxSunset = intval($fieldValue);
    	        }
	        }	        
	    }
	    
		$entry = entryPeer::retrieveByPK($entryId);
		if (!$entry) {
		    KalturaLog::err('Cannot find entry with id ['.$entryId.']');
		    return;
		}
		
		if (is_null($minSunrise)) { $minSunrise = $entry->getStartDate(null); };
		if (is_null($maxSunset))  { $maxSunset = $entry->getEndDate(null); };
		
	    if (!is_null($minSunrise) && !is_null($maxSunset) && $minSunrise >= $maxSunset) {
	        KalturaLog::log('Cannot save start date ['.$minSunrise.'] which is later then end date ['.$maxSunset.']');   
	        return;
	    }
		
		if ($minSunrise != $entry->getStartDate(null) || $maxSunset != $entry->getEndDate(null))
		{
		    KalturaLog::debug('Updating entry id ['.$entryId.'] with startDate ['.$minSunrise.'] endDate ['.$maxSunset.']');
		    $entry->setStartDate($minSunrise);
		    $entry->setEndDate($maxSunset);
		    self::setMinSunrise($entry, $minSunrise);
		    self::setMaxSunset($entry, $maxSunset);
		    $entry->save();
		}
		else
		{
		    KalturaLog::debug('No change done for entry ');
		} 
	}
	
	
	protected static function getMinSunrise(entry $entry)
	{
	    return $entry->getFromCustomData(AbcSpecificPlugin::getPluginName().'_'.self::CUSTOM_DATA_ENTRY_MIN_SUNRISE_FIELD);
	}
	
	protected static function setMinSunrise(entry $entry, $sunrise)
	{
	    return $entry->putInCustomData(AbcSpecificPlugin::getPluginName().'_'.self::CUSTOM_DATA_ENTRY_MIN_SUNRISE_FIELD, $sunrise);
	}
	
    protected static function getMaxSunset(entry $entry)
	{
	    return $entry->getFromCustomData(AbcSpecificPlugin::getPluginName().'_'.self::CUSTOM_DATA_ENTRY_MAX_SUNSET_FIELD);
	}
	
    protected static function setMaxSunset(entry $entry, $sunset)
	{
	    return $entry->putInCustomData(AbcSpecificPlugin::getPluginName().'_'.self::CUSTOM_DATA_ENTRY_MAX_SUNSET_FIELD, $sunset);
	}
	
	
}