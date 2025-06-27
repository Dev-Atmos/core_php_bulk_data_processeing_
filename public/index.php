<?php
require_once __DIR__ . '/../bootstrap.php';

use App\Helpers\Router;

// Adjust this if your project folder name changes
$basePath = '/core_php_bulk_data_processeing_/public';

$uri = str_replace($basePath, '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
Router::route($uri ?: '/');
