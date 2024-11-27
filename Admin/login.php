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
      // Redirecting to Admin Dashboard on correct email and password
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
    /* Simple Background (No Color) */
    body {
      background-color: #f8f9fa;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    /* Styling for the Login Box */
    .form-container {
      background-color: #ffffff;
      border-radius: 12px;
      padding: 40px 35px;
      box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
      transition: all 0.3s ease;
    }

    /* Hover effect for the Login Box */
    .form-container:hover {
      box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.2);
      transform: translateY(-5px);
    }

    .form-container h2 {
      color: #2c3e50;
      font-size: 32px;
      text-align: center;
      margin-bottom: 30px;
      font-weight: 700;
    }

    /* Label and Input Fields */
    .form-group {
      position: relative;
      margin-bottom: 25px;
    }

    .form-group i {
      position: absolute;
      top: 12px;
      left: 12px;
      font-size: 18px;
      color: #00796b;
    }

    .form-control {
      padding-left: 40px;
      border-radius: 30px;
      border: 1px solid #00796b;
      transition: all 0.3s ease;
      height: 45px;
    }

    .form-control:focus {
      border-color: #004d40;
      box-shadow: 0 0 8px rgba(0, 77, 64, 0.5);
    }

    /* Login Button */
    .btn-login {
      background-color: #00796b;
      color: white;
      font-weight: bold;
      border-radius: 30px;
      padding: 12px;
      width: 100%;
      border: none;
      text-transform: uppercase;
      transition: background 0.3s ease, transform 0.3s ease;
    }

    .btn-login:hover {
      background-color: #004d40;
      transform: translateY(-3px);
    }

    /* Back Button */
    .btn-info {
      background-color: #004d40;
      color: white;
      font-weight: bold;
      border-radius: 30px;
      padding: 12px;
      width: 100%;
      border: none;
      margin-top: 20px;
      text-align: center;
      transition: background-color 0.3s ease;
    }

    .btn-info:hover {
      background-color: #00796b;
    }

    /* Alert Styling */
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
      <i class="fas fa-user-cog" style="font-size: 40px; color: #00796b;"></i>
      <h2>Admin Login - Online Maintenance Management System</h2>
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
