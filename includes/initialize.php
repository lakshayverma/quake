<?php

// Web site constants
defined('DS') ? null : define('DS', '\\');
//defined('SITE_ROOT') ? null : define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT']);
defined('SITE_ROOT') ? null : define('SITE_ROOT', "C:" . DS . "wamp64" . DS . "www" . DS . "quake");
defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT . DS . 'includes');
defined('UPLOAD_PATH') ? null : define('UPLOAD_PATH', SITE_ROOT . DS . 'uploads');

if (!is_dir(UPLOAD_PATH)) {
    mkdir(UPLOAD_PATH, 0777, true);
}
// load configuration file
require_once(LIB_PATH . DS . "config.php");

// load basic functions
require_once(LIB_PATH . DS . "functions.php");

// load core objects
require_once(LIB_PATH . DS . "session.php");
require_once(LIB_PATH . DS . "database.php");
require_once(LIB_PATH . DS . "database_object.php");

// load database-related classes
require_once(LIB_PATH . DS . "user.php");
?>