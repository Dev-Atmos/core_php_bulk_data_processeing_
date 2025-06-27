<?php include __DIR__ . '/../layout/header.php'; ?>

<h2>Register</h2>
<form action="<?= base_url('register-submit') ?>" method="post">
  <div class="mb-3">
    <input type="text" name="name" class="form-control" placeholder="Full Name" required>
  </div>
  <div class="mb-3">
    <input type="email" name="email" class="form-control" placeholder="Email" required>
  </div>
  <div class="mb-3">
    <input type="password" name="password" class="form-control" placeholder="Password" required>
  </div>
  <button type="submit" class="btn btn-success">Register</button>
</form>
<p><?= displayFlashMessage('registered') ?></p>
<p class="mt-3"><a href="<?=base_url('login')?>">Back to Login</a></p>

<?php include __DIR__ . '/../layout/footer.php'; ?>