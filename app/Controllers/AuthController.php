<?php

namespace App\Controllers;

use App\Models\User;

class AuthController
{
    public function login()
    {
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        if (!$email || !$password) {
            die("Email and password required.");
        }

        $user = User::findByEmail($email);
        if (!$user || !password_verify($password, $user['password'])) {
            die("Invalid credentials.");
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];

        header("Location: " . base_url('dashboard'));
        exit;
    }

    public function register()
    {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        if (!$name || !$email || !$password) {
            die("All fields required.");
        }

        if (User::exists($email)) {
            die("Email already registered.");
        }

        User::create($name, $email, $password);
        flashMessage('registered', "Registration successful! Please login.", 'success');
        header("Location: " . base_url('register'));

        exit;
    }

    public function logout()
    {
        session_destroy();
        header("Location: " . base_url());
        exit;
    }

    public function isLoggedIn()
    {
        return isset($_SESSION['user_id']);
    }
}
