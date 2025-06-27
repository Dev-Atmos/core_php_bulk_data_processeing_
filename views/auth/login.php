<?php include __DIR__ . '/../layout/header.php'; ?>

<h2>Login</h2>
<form action="<?=base_url()?>login-submit" method="post">
  <div class="mb-3">
    <input type="email" name="email" class="form-control" placeholder="Email" required>
  </div>
  <div class="mb-3">
    <input type="password" name="password" class="form-control" placeholder="Password" required>
  </div>
  <button type="submit" class="btn btn-primary">Login</button>
</form>
<p class="mt-3">Don't have an account? <a href="<?=base_url()?>register">Register here</a></p>

<?php include __DIR__ . '/../layout/footer.php'; ?>
