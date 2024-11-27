<?php
include('../dbConnection.php');
session_start();
if(!isset($_SESSION['is_login'])){
  if(isset($_REQUEST['rEmail'])){
    $rEmail = mysqli_real_escape_string($conn,trim($_REQUEST['rEmail']));
    $rPassword = mysqli_real_escape_string($conn,trim($_REQUEST['rPassword']));
    $sql = "SELECT r_email, r_password FROM requesterlogin_tb WHERE r_email='".$rEmail."' AND r_password='".$rPassword."' limit 1";
    $result = $conn->query($sql);
    if($result->num_rows == 1){
      
      $_SESSION['is_login'] = true;
      $_SESSION['rEmail'] = $rEmail;
      // Redirecting to RequesterProfile page on Correct Email and Pass
      echo "<script> location.href='RequesterProfile.php'; </script>";
      exit;
    } else {
      $msg = '<div class="alert alert-danger mt-2" role="alert"> Enter Valid Email and Password </div>';
    }
  }
} else {
  echo "<script> location.href='RequesterProfile.php'; </script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">

  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="../css/all.min.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <style>
    body {
      background-color: #f2f4f8;
      font-family: 'Poppins', sans-serif;
    }

    .login-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      padding: 20px;
    }

    .login-card {
      background: linear-gradient(145deg, #80deea, #26a69a);
      border-radius: 20px;
      box-shadow: 0px 15px 30px rgba(0, 0, 0, 0.1);
      padding: 40px;
      width: 100%;
      max-width: 500px; /* Increased width */
      transform: scale(1);
      transition: transform 0.3s ease;
    }

    .login-card:hover {
      transform: scale(1.05); /* Slight zoom effect on hover */
    }

    .login-card h1 {
      color: #fff;
      font-size: 36px;
      margin-bottom: 30px; /* Increased margin */
      text-align: center;
      font-weight: 600;
    }

    .login-card .form-group label {
      color: #fff;
      font-weight: 600;
    }

    .login-card .form-control {
      border-radius: 12px;
      padding: 14px 18px;
      font-size: 16px;
      margin-bottom: 20px;
    }

    .login-card .btn {
      background-color: #004d40;
      color: #fff;
      border-radius: 12px;
      padding: 14px;
      font-weight: bold;
      width: 100%;
      transition: background-color 0.3s, transform 0.3s ease;
    }

    .login-card .btn:hover {
      background-color: #00796b;
      transform: translateY(-2px); /* Subtle raise on hover */
    }

    .login-card .btn-back {
      background-color: #80deea;
      border-radius: 12px;
      padding: 14px;
      font-weight: bold;
      text-align: center;
      width: 100%;
      transition: background-color 0.3s, transform 0.3s ease;
    }

    .login-card .btn-back:hover {
      background-color: #26a69a;
      transform: translateY(-2px); /* Subtle raise on hover */
    }

    .login-logo {
      text-align: center;
      font-size: 40px;
      color: #004d40;
      margin-bottom: 30px;
    }

    .login-logo i {
      font-size: 60px;
    }

    .alert {
      font-size: 14px;
      padding: 10px;
      margin-top: 15px;
    }

  </style>

  <title>Login</title>
</head>

<body>
  <div class="login-container">
    <div class="login-card shadow-lg">
      <!-- Logo Section -->
      <div class="login-logo mb-4">
      <i class="fas fa-lock"></i>
        <div>Online Maintenance Management System</div>
      </div>

      <!-- Requester Login Form -->
      <form action="" method="POST">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" placeholder="Email" name="rEmail" required>
          <small class="form-text">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
          <label for="pass">Password</label>
          <input type="password" class="form-control" placeholder="Password" name="rPassword" required>
        </div>
        <button type="submit" class="btn mt-3">Login</button>
        <?php if(isset($msg)) {echo $msg; } ?>
      </form>

      <!-- Back to Home Button -->
      <div class="text-center mt-3">
        <a class="btn btn-back" href="../index.php">Back to Home</a>
      </div>
    </div>
  </div>

  <!-- Boostrap JavaScript -->
  <script src="../js/jquery.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/all.min.js"></script>
</body>

</html>
