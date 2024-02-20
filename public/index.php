<?php


namespace PHPMVC;

use PHPMVC\lib\FrontController;
use PHPMVC\lib\Template;

if (!defined("DS")) {
    define("DS", DIRECTORY_SEPARATOR);
}

// ** Require Config Path -> APP PATH - VIEWS PATH - TEMPLATE PATH , CSS,JS PATH , DATABASE Credentials
require_once '..' . DS . "app" . DS . 'config' . DS . 'config.php';

// ** Require Template Config Path
$template_parts = require_once APP_PATH . DS . "config" . DS . "templateconfig.php";

// ** Require AutoLoad Path
require_once APP_PATH . DS . "lib" . DS . "autoload.php";

// ** Start Session
session_start();

// ** Make Template Object
$template = new Template($template_parts);

// ** Assign Template Object to FrontController new Object
$frontController = new FrontController($template);

// ** Run 
$frontController->dispatch();


