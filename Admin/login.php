<?php
include('../dbConnection.php');
session_start();
if(!isset($_SESSION['is_adminlogin'])){
  if(isset($_REQUEST['aEmail'])){
    $aEmail = mysqli_real_escape_string($conn,trim($_REQUEST['aEmail']));
    $aPassword = mysqli_real_escape_string($conn,trim($_REQUEST['aPassword']));
    $sql = "SELECT a_email, a_password FROM adminlogin_tb WHERE a_email='".$aEmail."' AND a_password='".$aPassword."' limit 1";
    $result = $conn->query($sql);
    if($result->num_rows == 1){
      $_SESSION['is_adminlogin'] = true;
      $_SESSION['aEmail'] = $aEmail;
      echo "<script> location.href='dashboard.php'; </script>";
      exit;
    } else {
      $msg = '<div class="alert alert-warning mt-2" role="alert"> Enter Valid Email and Password </div>';
    }
  }
} else {
  echo "<script> location.href='dashboard.php'; </script>";
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

  <style>
    body {
      background: linear-gradient(135deg, #c2e9fb 0%, #a1c4fd 100%); /* Soft gradient background */
      height: 100vh;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Arial', sans-serif;
    }

    .form-container {
      background-color: #ffffff; /* White background for the form */
      border-radius: 15px;
      padding: 40px 35px;
      width: 100%;
      max-width: 400px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease-in-out;
    }

    .form-container:hover {
      box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15);
      transform: translateY(-5px);
    }

    .form-container h2 {
      color: #4f8aff; /* Gradient light blue color for the heading */
      font-size: 48px; /* Larger and more bold */
      text-align: center;
      margin-bottom: 30px;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 2px;
      background: linear-gradient(135deg, #ff6f61, #f7b42c); /* Gradient text */
      -webkit-background-clip: text;
      color: transparent;
      text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1); /* Subtle text shadow */
      animation: fadeIn 1.5s ease-in-out;
    }

    @keyframes fadeIn {
      0% {
        opacity: 0;
        transform: translateY(-50px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .form-group {
      position: relative;
      margin-bottom: 25px;
    }

    .form-group i {
      position: absolute;
      top: 12px;
      left: 12px;
      font-size: 20px;
      color: #2d9cdb;
    }

    .form-control {
      padding-left: 40px;
      border-radius: 25px;
      border: 1px solid #2d9cdb;
      height: 45px;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color: #1c6f8c;
      box-shadow: 0 0 8px rgba(28, 111, 140, 0.5);
    }

    .btn-login {
      background-color: #2d9cdb; /* Light blue for the login button */
      color: white;
      font-weight: bold;
      border-radius: 30px;
      padding: 14px;
      width: 100%;
      border: none;
      text-transform: uppercase;
      transition: background 0.3s ease, transform 0.3s ease;
    }

    .btn-login:hover {
      background-color: #191970; /* Hover color that complements the gradient */
      transform: translateY(-3px);
    }

    .btn-info {
      background-color: #1c6f8c; /* Darker blue for the back button */
      color: white;
      font-weight: bold;
      border-radius: 30px;
      padding: 14px;
      width: 100%;
      border: none;
      margin-top: 20px;
      transition: background-color 0.3s ease;
    }

    .btn-info:hover {
      background-color:#0000CD; /* Hover color that matches the gradient tones */
    }

    .alert {
      margin-top: 15px;
      border-radius: 5px;
    }
  </style>

  <title>Admin Login</title>
</head>

<body>
  <div class="container">
    <div class="text-center mb-3">
      <i class="fas fa-user-cog" style="font-size: 50px; color: #2d9cdb;"></i>
      <h2>Admin Login</h2>
    </div>

    <div class="row justify-content-center">
      <div class="col-sm-6 col-md-4">
        <div class="form-container">
          <form action="" method="POST">
            <div class="form-group">
              <i class="fas fa-user"></i>
              <label for="aEmail" class="pl-2 font-weight-bold">Email</label>
              <input type="email" class="form-control" placeholder="Enter your email" name="aEmail" required>
            </div>

            <div class="form-group">
              <i class="fas fa-key"></i>
              <label for="aPassword" class="pl-2 font-weight-bold">Password</label>
              <input type="password" class="form-control" placeholder="Enter your password" name="aPassword" required>
            </div>

            <button type="submit" class="btn btn-login shadow-sm">Login</button>
            <?php if(isset($msg)) {echo $msg; } ?>
          </form>

          <a href="../index.php" class="btn btn-info shadow-sm">Back to Home</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JavaScript -->
  <script src="../js/jquery.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/all.min.js"></script>
</body>

</html>
