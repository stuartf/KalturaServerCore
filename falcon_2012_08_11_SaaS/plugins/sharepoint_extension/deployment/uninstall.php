<?php

/**
 * This file is emant to be the install script for the Kaltura Sharepoint extension plugin
 */

// this would work on linux
$php_command = @$_SERVER["_"];
// if not working, fallback to default
if(!$php_command) $php_command = 'php';

//$uiconf_deployment_script = realpath(dirname(__FILE__) . '/../../../') . '/deployment/uiconf/deploy_v2.php';
//$uiconf_deployment_config = realpath(dirname(__FILE__)) . '/uiconf/config.ini';

//passthru("$php_command $uiconf_deployment_script --ini=$uiconf_deployment_config");

$script = realpath(dirname(__FILE__) . '/../../../') . '/scripts/utils/permissions/removePermissionsAndItems.php';
$config = realpath(dirname(__FILE__)) . '/add_permissions/sharepoint_permissions.ini';
passthru("$php_command $script $config");
