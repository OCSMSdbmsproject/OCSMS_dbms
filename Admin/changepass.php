<?php
define('TITLE', 'Change Password');
define('PAGE', 'changepass');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();
if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
} else {
  echo "<script> location.href='login.php'; </script>";
}
$aEmail = $_SESSION['aEmail'];
if(isset($_REQUEST['passupdate'])){
  if(($_REQUEST['aPassword'] == "")){
    $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fields </div>';
  } else {
    $sql = "SELECT * FROM adminlogin_tb WHERE a_email='$aEmail'";
    $result = $conn->query($sql);
    if($result->num_rows == 1){
      $aPass = $_REQUEST['aPassword'];
      $sql = "UPDATE adminlogin_tb SET a_password = '$aPass' WHERE a_email = '$aEmail'";
      if($conn->query($sql) == TRUE){
        $passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Updated Successfully </div>';
      } else {
        $passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update </div>';
      }
    }
  }
}
?>

<!-- Styling for the page -->
<style>
  body {
    background: #f3f7fb; /* Light grey background */
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
  }

  .form-container {
    background: #ffffff;
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    max-width: 600px;
    margin: 80px auto;
    text-align: center;
    background-color: #f8f9fd;
  }

  .form-container:hover {
    transform: scale(1.02);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
  }

  .form-header {
    background: linear-gradient(90deg, #7F00FF, #FF00FF);
    color: #ffffff;
    padding: 20px;
    border-radius: 15px 15px 0 0;
    font-size: 1.8rem;
    font-weight: bold;
    text-align: center;
  }

  .form-group label {
    font-weight: bold;
    color: #444;
  }

  .form-control {
    background-color: #e8eff9;
    border: 1px solid #dcdcdc;
    border-radius: 8px;
    padding: 12px;
    margin-top: 10px;
    transition: background-color 0.3s ease;
  }

  .form-control:focus {
    background-color: #ffffff;
    border-color: #7F00FF;
    box-shadow: 0 0 8px rgba(127, 0, 255, 0.5);
  }

  .btn-update {
    background: linear-gradient(90deg, #add8e6, #87cefa);
    color: #ffffff;
    border: none;
    border-radius: 10px;
    padding: 12px 25px;
    margin-top: 25px;
    font-size: 1.2rem;
    transition: background 0.3s, box-shadow 0.3s, transform 0.2s ease;
  }

  .btn-update:hover {
    background: linear-gradient(90deg, #4169e1, #1e90ff);
    box-shadow: 0 4px 15px rgba(65, 105, 225, 0.5);
    transform: scale(1.05);
  }

  .btn-reset {
    background-color: #dcdcdc;
    color: #444;
    border: none;
    border-radius: 10px;
    padding: 12px 25px;
    margin-top: 25px;
    font-size: 1.2rem;
    transition: background 0.3s, transform 0.2s ease;
  }

  .btn-reset:hover {
    background-color: #c6c6c6;
    transform: scale(1.05);
  }

  .alert {
    margin-top: 20px;
    border-radius: 10px;
  }

  .btn-update:active {
    transform: scale(1.02);
  }
</style>

<!-- Form Design -->
<div class="form-container">
  <div class="form-header">Change Your Admin Password</div>
  <form method="POST">
    <div class="form-group mt-4">
      <label for="inputEmail">Email</label>
      <input type="email" class="form-control" id="inputEmail" value="<?php echo $aEmail; ?>" readonly>
    </div>
    <div class="form-group">
      <label for="inputnewpassword">New Password</label>
      <input type="password" class="form-control" id="inputnewpassword" placeholder="Enter new password" name="aPassword">
    </div>
    <button type="submit" class="btn-update" name="passupdate">Update</button>
    <button type="reset" class="btn-reset">Reset</button>
    <?php if(isset($passmsg)) { echo $passmsg; } ?>
  </form>
</div>

<?php
include('includes/footer.php'); 
?>
