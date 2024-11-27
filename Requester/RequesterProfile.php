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

<div class="container mt-5 pt-5"> <!-- Added pt-5 for top padding -->
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm border-0 rounded-lg p-4" style="background: #ffffff;">
        <div class="card-header text-white text-center py-4" style="background: linear-gradient(90deg, rgba(255,0,150,1) 0%, rgba(0,204,255,1) 100%); border-radius: 15px 15px 0 0;">
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
            <button type="submit" class="btn btn-primary btn-lg btn-block" name="nameupdate">Update</button>
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
    background: linear-gradient(to right, #d0e9ff, #e3f2fd); /* Lightish blue gradient */
    font-family: 'Poppins', sans-serif;
  }
  .container {
    max-width: 800px;
  }
  .card {
    border-radius: 15px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth transition for hover effect */
  }
  .card:hover {
    transform: translateY(-10px); /* Slight lift on hover */
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); /* Deeper shadow on hover */
  }
  .card-header {
    font-size: 22px;
    font-weight: 600;
    padding: 30px 0;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    background: linear-gradient(90deg, rgba(255,0,150,1) 0%, rgba(0,204,255,1) 100%);
    border-radius: 15px 15px 0 0;
  }
  .btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    transition: background-color 0.3s ease, border-color 0.3s ease;
    font-size: 18px;
    padding: 12px;
    border-radius: 10px;
  }
  .btn-primary:hover {
    background-color: #0056b3;
    border-color: #004085;
  }
  .form-control {
    border-radius: 10px;
    font-size: 16px;
    padding: 15px;
    background-color: #f1f3f5;
    border: 2px solid #ced4da;
    transition: border-color 0.3s ease;
  }
  .form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 8px rgba(0, 123, 255, 0.25);
  }
  .form-group label {
    font-size: 16px;
    font-weight: 600;
  }
  .alert {
    border-radius: 10px;
    font-size: 14px;
    margin-top: 10px;
    text-align: center;
  }
  .alert-warning {
    background-color: #fff3cd;
    color: #856404;
  }
  .alert-success {
    background-color: #d4edda;
    color: #155724;
  }
  .alert-danger {
    background-color: #f8d7da;
    color: #721c24;
  }
</style>


