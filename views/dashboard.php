<?php
include __DIR__ . '/layout/header.php';
?>




<section>
    <p>This is your dashboard. You can manage your account, view your data, and more.</p>
    <p>Feel free to explore the features available to you.</p>
    <div class="row">
        <!-- You can add more content here, like user stats, links to other features, etc. -->
        <div class="col-md-12">
            <a href="<?= base_url('import-staging-data') ?>" class="btn btn-info">Import Staging Data</a>
        </div>
    </div>

</section>
<?php include __DIR__ . '/layout/footer.php'; ?>