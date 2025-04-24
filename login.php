<?php
include 'includes/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    // Allow login page to be accessed if user is not logged in
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();

  if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user'] = $user;
    header("Location: dashboard.php");
    exit();
  } else {
    $error = "Invalid email or password.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <style>
    body {
      background-color: #fff0f5;
      font-family: 'Segoe UI', sans-serif;
    }

    .login-container {
      margin-top: 100px;
    }

    .card {
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .bg-rose {
      background-color: #e91e63;
      color: white;
    }

    .btn-rose {
      background-color: #e91e63;
      color: white;
    }

    .btn-rose:hover {
      background-color: #c2185b;
      color: white;
    }
  </style>
</head>
<body>

<div class="container login-container">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card">
        <div class="card-header text-center bg-rose">
          <h3>Login</h3>
        </div>
        <div class="card-body">
          <?php if (isset($error)) { ?>
            <div class="alert alert-danger text-center"><?= $error ?></div>
          <?php } ?>
          <form method="post">
            <div class="mb-3">
              <label>Email</label>
              <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
              <label>Password</label>
              <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-rose w-100">Login</button>
          </form>
        </div>
        <div class="card-footer text-center">
          <small>Don't have an account? <a href="register.php" class="text-rose">Register</a></small>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
