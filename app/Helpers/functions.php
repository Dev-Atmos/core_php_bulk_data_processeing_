<?php

use App\Controllers\AuthController;

if (!function_exists('base_url')) {
    function base_url($path = '')
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
        $host = $_SERVER['HTTP_HOST'];

        // Set this manually if needed (e.g. "/project/public")
        $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');

        return $protocol . $host . $base . '/' . ltrim($path, '/');
    }
}

if (!function_exists('isLoggedIn')) {
    function isLoggedIn()
    {
        return isset($_SESSION['user_id']);
    }
}
if (!function_exists('redirect')) {
    function redirect($url)
    {
        header("Location: " . $url);
        exit;
    }
}
if (!function_exists('sanitize')) {
    function sanitize($data)
    {
        return htmlspecialchars(strip_tags(trim($data)));
    }
}
if (!function_exists('flashMessage')) {
    function flashMessage($key, $message, $type = 'info')
    {
        $_SESSION['flash_message'] = [
            'key' => $key,
            'message' => $message,
            'type' => $type
        ];
    }
}
if (!function_exists('displayFlashMessage')) {
    function displayFlashMessage($key)
    {
        if (isset($_SESSION['flash_message']) && $_SESSION['flash_message']['key'] === $key) {
            $flash = $_SESSION['flash_message'];
            echo '<div class="alert alert-' . htmlspecialchars($flash['type']) . '">';
            echo htmlspecialchars($flash['message']);
            echo '</div>';
            unset($_SESSION['flash_message']);
        }
    }
}
if (!function_exists('getCurrentUser')) {
    function getCurrentUser()
    {
        return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    }
}
if (!function_exists('getUserName')) {
    function getUserName()
    {
        return isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Guest';
    }
}

if (!function_exists('url_segment')) {
    // function url_segment($index)
    // {
    //     $segments = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
    //     return isset($segments[$index]) ? $segments[$index] : null;
    // }
    function url_segment($n)
    {
        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $segments = explode('/', $uri);
        
        return $segments[$n - 1] ?? null;
    }
}
