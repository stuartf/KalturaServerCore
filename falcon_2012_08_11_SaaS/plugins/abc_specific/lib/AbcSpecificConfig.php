<?php
/**
 * @package plugins.abcSpecific
 * @subpackage lib
 */
interface AbcSpecificConfig
{   
    // custom data field keys
    const MRM_ID = 'MRMID';
    const OBJECT_SUB_TYPE = 'ObjectSubType';
    const TMS_ID = 'TMSID';
    const SHOWS = 'Shows';
    const SHOW_TYPE = 'ShowType';
    const SHOW_AD_TARGET = 'ShowAdTarget';
    const VIDEO_WORFLOW_ID = 'VWID';
    const SEASON = 'Season';
    const EPISODE_SEQUENCE_NUMBER = 'EpisodeSequenceNumber';
    const PART = 'Part';
    const VERSION = 'Version';
    const OBJECT_TYPE = 'ObjectType';
    const KALTURA_ID = 'KalturaID';
    
    const SUNRISE_FIELDS = 'SunriseSiteFree,SunriseSitePaid,SunriseTabletFree,SunriseTabletPaid,SunriseCellFree,SunriseCellPaid,SunriseSitePromo,SunriseTabletPromo,SunriseCellPromo';
    const SUNSET_FIELDS = 'SunsetSiteFree,SunsetSitePaid,SunsetTabletFree,SunsetTabletPaid,SunsetCellFree,SunsetCellPaid,SunsetSitePromo,SunsetTabletPromo,SunsetCellPromo';
        
     // custome metadata values
    const CLIP_OBJECT_SUB_TYPES = 'Short Clip,Podcast';
    const MOVIE_SHOW_TYPE = 'Movie';
    const MOVIE_SHOW_NAMES = 'ABC Family Movie Show';
    const SPECIAL_SHOW_NAMES = 'ABC News Specials Show,ABC News Shows Show,007 - Upfronts Show';
    const OBJECT_TYPE_SERIES = 'Series';
}