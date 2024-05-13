<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
define('BASE_PATH', dirname(__FILE__, 2));
define('APP_FOLDER', 'simpleadmin');
define('CURRENT_PAGE', basename((string)$_SERVER['REQUEST_URI']));

require_once BASE_PATH . '/MysqliDb/MysqliDb.php';
require_once BASE_PATH . '/helpers/helpers.php';


/*
|--------------------------------------------------------------------------
| DATABASE CONFIGURATION
|--------------------------------------------------------------------------
 */

define('DB_HOST', "localhost:3306");
define('DB_USER', "a0458868_bagetnaya"); #
define('DB_PASSWORD', "1226591Qwer"); #
define('DB_NAME', "a0458868_bagetnaya"); #

/**
 * Get instance of DB object
 */
function getDbInstance()
{
    return new MysqliDb(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
}
