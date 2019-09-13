<?php
/**
 * place any configurations related to php.ini here
 * this script is called from app.php
 * @author Md Fahim Uddin
 * @version 20160418
 */
//set display error
if (APP_MODE == 'test') {
    if (!ini_get('display_errors')) {
        ini_set('display_errors', '1');
        error_reporting(E_ALL);
    }
} else {
    if (ini_get('display_errors')) {
        ini_set('display_errors', '0');
        error_reporting(0);
    }
}