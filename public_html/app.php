<?php
/**
 * default landing page
 * all requests get passed through page
 * @author Md Fahim Uddin
 * @version 20160416
 */
//Start new or resume existing session
session_start();

/**
 * set application mode
 * @expected "live" or "test"
 */
define('APP_MODE', 'test');

//set include paths
set_include_path(
    get_include_path() . PATH_SEPARATOR .
    dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'app'
);

//set error handler
require_once('Configs/Configs_php.ini.php');

//add loader
require_once('Lib/Lib_Loader.php');

//load application
try {
    ZIT()->Lib_App->loadApp();
} catch (Exception $e) {
    echo $e->getMessage();
}