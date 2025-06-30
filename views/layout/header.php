<!DOCTYPE html>
<html>

<head>
  <title>Login System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?=base_url()?>assets/css/style.css">

</head>

<body>
  <?php include __DIR__ . '/navbar.php'; ?>
  <div class="container mt-5">
    <?php
    if (isLoggedIn() == true) {
      // If user is logged in, show welcome message and logout button
      echo '<div class="row justify-content-center align-items-center g-2 mb-4">';
      echo '<div class="col"><h2>Welcome, ' . htmlspecialchars($_SESSION['name']) . '!</h2></div>';      
      echo '</div>';
    }
    ?>

    <div class="text-center">
      <h1 class="mb-4">🧾 Bulk CSV Importer</h1>
      <p class="lead">Upload, validate, and process large CSV files easily with this Core PHP app.</p>      
    </div>