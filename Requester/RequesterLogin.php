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

  <style>
    /* Background Styling */
    body {
      background: linear-gradient(135deg, #e3f2fd, #bbdefb); /* Light blue gradient */
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    /* Login Box Styling */
    .form-container {
      background: linear-gradient(135deg, #ffffff, #e0f7fa); /* Light and attractive gradient */
      border-radius: 12px;
      padding: 40px 35px;
      box-shadow: 0px 6px 18px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 450px;
      transition: all 0.3s ease;
    }

    .form-container:hover {
      box-shadow: 0px 8px 25px rgba(0, 0, 0, 0.2);
    }

    /* Requester Login Heading */
    .form-title {
      color: #006064; /* Deep teal */
      font-size: 28px;
      text-align: center;
      font-weight: bold;
      margin-bottom: 25px;
    }

    /* Input Fields */
    .form-group {
      position: relative;
      margin-bottom: 20px;
    }

    .form-group i {
      position: absolute;
      top: 12px;
      left: 12px;
      font-size: 18px;
      color: #006064;
    }

    .form-control {
      padding-left: 40px;
      border-radius: 30px;
      border: 1px solid #80deea;
      transition: all 0.3s ease;
      height: 45px;
    }

    .form-control:focus {
      border-color: #80deea;
      box-shadow: 0 0 8px rgba(128, 222, 234, 0.5);
    }

    /* Buttons */
    .btn-login {
      background-color: #80deea; /* Specified button color */
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
      background-color: #4bacb8; /* Hover effect */
      transform: translateY(-3px);
    }

    .btn-info {
      background-color: #80deea;
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
      background-color: #4bacb8;
    }

    /* Lock Icon Styling */
    .logo {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-bottom: 20px;
    }

    .logo i {
      font-size: 360px; /* Increased icon size to 360px (2 times bigger) */
      color: #006064; /* Match color to the heading */
    }
  </style>

  <title>Requester Login</title>
</head>

<body>
  <div class="container text-center">
    <!-- Login-related Logo (Lock Icon) -->
    <div class="logo">
      <i class="fas fa-lock"></i> <!-- Font Awesome lock icon -->
    </div>

    <!-- Requester Login Heading -->
    <h2 class="form-title">Requester Login</h2>
    <div class="row justify-content-center">
      <div class="col-sm-6 col-md-4">
        <div class="form-container">
          <form action="" method="POST">
            <div class="form-group">
              <i class="fas fa-user"></i>
              <label for="rEmail" class="pl-2 font-weight-bold">Email</label>
              <input type="email" class="form-control" placeholder="Enter your email" name="rEmail" required>
            </div>

            <div class="form-group">
              <i class="fas fa-key"></i>
              <label for="rPassword" class="pl-2 font-weight-bold">Password</label>
              <input type="password" class="form-control" placeholder="Enter your password" name="rPassword" required>
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














