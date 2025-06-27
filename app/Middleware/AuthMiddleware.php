<?php

namespace App\Middleware;

class AuthMiddleware
{
    public static function check()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . base_url());
            exit;
        }
    }
    public static function isLoggedIn()
    {
        return isset($_SESSION['user_id']);
    }
    public static function getCurrentUser()
    {
        return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    }
    public static function getUserName()
    {
        return isset($_SESSION['name']) ? $_SESSION['name'] : 'Guest';
    }
    public static function redirectIfNotLoggedIn()
    {
        if (!self::isLoggedIn()) {
            header('Location: ' . base_url() . 'login');
            exit;
        }
    }
}
