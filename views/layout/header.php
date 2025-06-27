<!DOCTYPE html>
<html>

<head>
  <title>Login System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container mt-5">
    <?php    
    if (isLoggedIn()==true) {
      // If user is logged in, show welcome message and logout button
      echo '<div class="row justify-content-center align-items-center g-2 mb-4">';
      echo '<div class="col"><h2>Welcome, ' . htmlspecialchars($_SESSION['user_name']) . '!</h2></div>';
      echo '<div class="col float-end"><a href="' . base_url('logout') . '" class="btn btn-danger mt-3">Logout</a></div>';
      echo '</div>';
    } 
    ?>
    