<?php

namespace App\Controllers;
class DashboardController
{
    public function index()
    {
        // Load the dashboard view
        load_view('dashboard');
    }

    public function settings()
    {
        // Load the settings view
        // load_view('dashboard/settings');
    }

    public function profile()
    {
        // Load the profile view
        // load_view('dashboard/profile');
    }
}
