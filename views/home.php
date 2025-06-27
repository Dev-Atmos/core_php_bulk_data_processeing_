<?php include __DIR__ . '/layout/header.php'; ?>

<div class="text-center">
  <h1 class="mb-4">🧾 Bulk CSV Importer</h1>
  <p class="lead">Upload, validate, and process large CSV files easily with this Core PHP app.</p>

  <?php if (!isset($_SESSION['user_id'])): ?>
    <div class="mt-4">
      <a href="<?=base_url()?>login" class="btn btn-primary me-2">Login</a>
      <a href="<?=base_url()?>register" class="btn btn-outline-secondary">Register</a>
    </div>
  <?php else: ?>
    <div class="mt-4">
      <a href="<?=base_url()?>dashboard" class="btn btn-success me-2">Go to Dashboard</a>
      <a href="<?= base_url('import-staging-data') ?>" class="btn btn-info me-2">Import CSV</a>
      <a href="<?= base_url('logout') ?>" class="btn btn-danger">Logout</a>
    </div>
  <?php endif; ?>
</div>

<?php include __DIR__ . '/layout/footer.php'; ?>
