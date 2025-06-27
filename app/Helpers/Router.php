<?php

namespace App\Helpers;

class Router
{
    private static $activeTab = '';

    public static function route($uri)
    {
        $uri = trim(parse_url($uri, PHP_URL_PATH), '/');
        $uri = '/' . $uri; // to match switch cases like '/login'

        switch ($uri) {
            case '/':
                require_once VIEW_PATH . 'home.php';
                self::$activeTab = 'home';
                return;

            case '/login':
                require_once VIEW_PATH . 'auth/login.php';
                self::$activeTab = 'login';
                return;

            case '/register':
                require_once VIEW_PATH . 'auth/register.php';
                self::$activeTab = 'register';
                return;

            case '/login-submit':
                (new \App\Controllers\AuthController)->login();
                return;

            case '/register-submit':
                (new \App\Controllers\AuthController)->register();
                return;

            case '/dashboard':
                \App\Middleware\AuthMiddleware::check();
                require_once VIEW_PATH . 'dashboard.php';
                self::$activeTab = 'dashboard';
                return;

            case '/logout':
                (new \App\Controllers\AuthController)->logout();
                return;

            case '/import-staging-data':
                \App\Middleware\AuthMiddleware::check();
                (new \App\Controllers\ImportStagingController)->form();
                self::$activeTab = 'import-staging-data';
                return;
            case '/import-staging-data-submit':
                \App\Middleware\AuthMiddleware::check();
                (new \App\Controllers\ImportStagingController)->importStagingDataSubmit();
                self::$activeTab = 'import-staging-data-submit';
                
                return;

            default:
                // If no static route matches, we assume it's a dynamic route
                // and will handle it in the fallback section.
                break;
        }

        // ✨ Dynamic Routing (fallback)
        $controllerName = ucfirst(url_segment(1)) . 'Controller';
        $methodName     = url_segment(2) ?: 'index';
        $params         = array_slice(explode('/', trim($uri, '/')), 2);

        $fullClass = "\\App\\Controllers\\$controllerName";

        if (class_exists($fullClass) && method_exists($fullClass, $methodName)) {
            call_user_func_array([new $fullClass, $methodName], $params);
        } else {
            http_response_code(404);
            // echo "404 - Not Found (dynamic route)";
            require_once VIEW_PATH . 'errors/404.php';
            self::$activeTab = '404';
            return;
        }
    }

    public static function getActiveTab()
    {
        return self::$activeTab;
    }
}
