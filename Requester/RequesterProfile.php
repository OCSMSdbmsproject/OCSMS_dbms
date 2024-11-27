<?php
define('TITLE', 'Requester Profile');
define('PAGE', 'RequesterProfile');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();
if($_SESSION['is_login']){
  $rEmail = $_SESSION['rEmail'];
} else {
  echo "<script> location.href='RequesterLogin.php'; </script>";
}

$sql = "SELECT * FROM requesterlogin_tb WHERE r_email='$rEmail'";
$result = $conn->query($sql);
if($result->num_rows == 1){
  $row = $result->fetch_assoc();
  $rName = $row["r_name"]; }

if(isset($_REQUEST['nameupdate'])){
  if(($_REQUEST['rName'] == "")){
    // msg displayed if required field missing
    $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fields </div>';
  } else {
    $rName = $_REQUEST["rName"];
    $sql = "UPDATE requesterlogin_tb SET r_name = '$rName' WHERE r_email = '$rEmail'";
    if($conn->query($sql) == TRUE){
      // below msg display on form submit success
      $passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Updated Successfully </div>';
    } else {
      // below msg display on form submit failed
      $passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update </div>';
    }
  }
}
?>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-header bg-primary text-white text-center py-4">
          <h4>Update Your Profile</h4>
        </div>
        <div class="card-body">
          <form method="POST">
            <div class="form-group mb-4">
              <label for="inputEmail" class="font-weight-bold">Email</label>
              <input type="email" class="form-control form-control-lg" id="inputEmail" value="<?php echo $rEmail ?>" readonly>
            </div>
            <div class="form-group mb-4">
              <label for="inputName" class="font-weight-bold">Name</label>
              <input type="text" class="form-control form-control-lg" id="inputName" name="rName" value="<?php echo $rName ?>" placeholder="Enter your full name" required>
            </div>
            <button type="submit" class="btn btn-success btn-lg btn-block" name="nameupdate">Update</button>
            <?php if(isset($passmsg)) {echo $passmsg; } ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include('includes/footer.php'); 
?>

<!-- Add Custom CSS for styling -->
<style>
  body {
    background-color: #f8f9fa;
    font-family: 'Poppins', sans-serif;
  }
  .container {
    max-width: 800px;
  }
  .card {
    border-radius: 15px;
  }
  .card-header {
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
  }
  .btn-success {
    background-color: #28a745;
    border-color: #28a745;
    transition: background-color 0.3s ease, border-color 0.3s ease;
    font-size: 18px;
  }
  .btn-success:hover {
    background-color: #218838;
    border-color: #1e7e34;
  }
  .form-control {
    border-radius: 10px;
    font-size: 16px;
    padding: 15px;
  }
  .form-group label {
    font-size: 16px;
    font-weight: 600;
  }
  .alert {
    border-radius: 10px;
    font-size: 14px;
  }
</style>
