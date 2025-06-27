<?php

use App\Helpers\Router;

$activeTab = url_segment(3) ?: 'dashboard'; // Default to 'dashboard' if no segment is present

?>

<ul
    class="nav nav-tabs mb-4">
    <li class="nav-item">
        <a href="<?= base_url('dashboard') ?>" class="nav-link <?= ($activeTab === 'dashboard') ? 'active' : '' ?>" aria-current="page">Home</a>
    </li>
    <li class="nav-item">
        <a href="<?= base_url('import-staging-data') ?>" class="nav-link <?= ($activeTab === 'import-staging-data') ? 'active' : '' ?>">Import Staging Data</a>
    </li>
    <li class="nav-item disabled">
        <a href="#" class="nav-link">Disabled</a>
    </li>
</ul>