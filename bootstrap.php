<?php
session_start();
define('BASE_PATH', realpath(__DIR__));

require_once __DIR__ . '/vendor/autoload.php'; // Autoload classes using Composer
require_once __DIR__ . '/config/db.php'; // DB connection
require_once __DIR__ . '/app/config/constants.php'; // Constants
require_once __DIR__ . '/app/Helpers/functions.php'; // Helper functions
require_once __DIR__ . '/app/Helpers/view.php'; // View helper functions

// ✅ PATH CONSTANTS


require_once BASE_PATH . '/app/config/constants.php'; // constants for views, assets, etc.
