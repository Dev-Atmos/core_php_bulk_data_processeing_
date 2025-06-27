<?php include __DIR__ . '/layout/header.php'; ?>

<div class="container">
  <h2 class="mb-3">📤 Upload CSV File</h2>

  <form action="<?= base_url('import-submit') ?>" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="csvFile" class="form-label">Choose CSV File</label>
      <input type="file" name="csv_file" id="csvFile" accept=".csv" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Import</button>
  </form>
</div>

<?php include __DIR__ . '/layout/footer.php'; ?>
