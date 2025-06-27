<?php

session_start();
require_once __DIR__ . '/vendor/autoload.php'; // Autoload classes using Composer
require_once __DIR__ . '/config/db.php'; // DB connection
require_once __DIR__ . '/app/config/constants.php'; // Constants
require_once __DIR__ . '/app/Helpers/functions.php'; // Helper functions

// ✅ PATH CONSTANTS
define('BASE_PATH', realpath(__DIR__));
define('APP_PATH', BASE_PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR);
define('CONTROLLER_PATH', APP_PATH . DIRECTORY_SEPARATOR . 'Controllers' . DIRECTORY_SEPARATOR);
define('MODEL_PATH', APP_PATH . DIRECTORY_SEPARATOR . 'Models' . DIRECTORY_SEPARATOR);
define('VIEW_PATH', BASE_PATH . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
define('ASSET_PATH', BASE_PATH . DIRECTORY_SEPARATOR . 'public/assets' . DIRECTORY_SEPARATOR);
define('LAYOUT_PATH', VIEW_PATH . DIRECTORY_SEPARATOR . 'layout' . DIRECTORY_SEPARATOR);
define('HELPER_PATH', APP_PATH . DIRECTORY_SEPARATOR . 'Helpers' . DIRECTORY_SEPARATOR);
define('ROUTER_PATH', HELPER_PATH . DIRECTORY_SEPARATOR . 'Router.php');
define('UPLOAD_PATH', BASE_PATH . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR);
