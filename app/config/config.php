<?php

if (!defined("DS")) {
    define("DS", DIRECTORY_SEPARATOR);
}

// ** APP Paths
define("APP_PATH", realpath(dirname(__FILE__) . DS . '..'));
define("VIEWS_PATH", APP_PATH . DS . "views" . DS);
define("TEMPLATE_PATH", APP_PATH . DS . "template" . DS);



// ** CSS & JS Paths In public
define("CSS", "/css/");
define("JS", "/js/");




// ** Database Credentials
defined('DATABASE_HOST_NAME') ? null : define('DATABASE_HOST_NAME', 'localhost');
defined('DATABASE_USER_NAME') ? null : define('DATABASE_USER_NAME', 'root');
defined('DATABASE_PASSWORD') ? null : define('DATABASE_PASSWORD', '1234');
defined('DATABASE_DB_NAME') ? null : define('DATABASE_DB_NAME', 'dotjo_task');
defined('DATABASE_PORT_NUMBER') ? null : define('DATABASE_PORT_NUMBER', 3306);
defined('DATABASE_CONN_DRIVER') ? null : define('DATABASE_CONN_DRIVER', 1);
