<?php

use App\Helpers\Router;

$activeTab = url_segment(3) ?: 'dashboard'; // Default to 'dashboard' if no segment is present

?>

<!-- ✅ Sticky Multilevel Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url() ?>">🧾 CSV Importer</a>
        <!-- Mobile toggle button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNavbar">
        <?php
        // If you want to use a specific base URL for the brand link, uncomment the line below

        if (isLoggedIn()) {
        ?>
            <!-- Navbar content -->

            <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-white">
                <!-- Basic item -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('dashboard') ?>">Dashboard</a>
                </li>

                <!-- First-level dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Import</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= base_url('import-staging-data') ?>">Upload raw CSV</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('seed-ecommerce') ?>">Seed E-commerce Data</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('seed-product-order') ?>">Seed Product Order</a></li>

                        <!-- Submenu inside Import -->
                        <li class="dropdown-submenu">
                            <a class="dropdown-item dropdown-toggle" href="#">Manage Data</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">View Staging</a></li>
                                <li><a class="dropdown-item" href="#">Validate Records</a></li>
                            </ul>
                        </li>

                        <li><a class="dropdown-item" href="#">Final Import</a></li>
                    </ul>
                </li>

                <!-- Second dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Reports</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Daily Report</a></li>
                        <li><a class="dropdown-item" href="#">Failed Imports</a></li>
                    </ul>
                </li>
            </ul>

            <!-- Right side content -->
            <span class="navbar-text text-white me-3">Welcome, <?=$_SESSION['name']?>!</span>
            <a href="<?= base_url('logout') ?>" class="btn btn-outline-danger btn-sm">Logout</a>

        <?
        } else {
        ?>
            <!-- Right side content -->
            <span class="navbar-text text-white me-3"></span>
            <a href="<?= base_url('login') ?>" class="btn btn-outline-danger btn-sm">Login</a>
        <?
        }
        ?>

    </div>


    </div>
</nav>