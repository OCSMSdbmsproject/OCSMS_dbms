<?php
  include('dbConnection.php');

  if(isset($_REQUEST['rSignup'])){
    // Checking for Empty Fields
    if(($_REQUEST['rName'] == "") || ($_REQUEST['rEmail'] == "") || ($_REQUEST['rPassword'] == "")){
      $regmsg = '<div class="alert alert-warning mt-2" role="alert"> All Fields are Required </div>';
    } else {
      $sql = "SELECT r_email FROM requesterlogin_tb WHERE r_email='".$_REQUEST['rEmail']."'";
      $result = $conn->query($sql);
      if($result->num_rows == 1){
        $regmsg = '<div class="alert alert-warning mt-2" role="alert"> Email ID Already Registered </div>';
      } else {
        // Assigning User Values to Variable
        $rName = $_REQUEST['rName'];
        $rEmail = $_REQUEST['rEmail'];
        $rPassword = $_REQUEST['rPassword'];
        $sql = "INSERT INTO requesterlogin_tb(r_name, r_email, r_password) VALUES ('$rName','$rEmail', '$rPassword')";
        if($conn->query($sql) == TRUE){
          $regmsg = '<div class="alert alert-success mt-2" role="alert"> Account Succefully Created </div>';
        } else {
          $regmsg = '<div class="alert alert-danger mt-2" role="alert"> Unable to Create Account </div>';
        }
      }
    }
  }
?>
<div class="container pt-5" id="registration">
  <h2 class="text-center mb-4">CREATE AN ACCOUNT</h2>
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-lg border-light">
        <div class="card-body">
          <form action="" method="POST">
            <div class="form-group">
              <i class="fas fa-user"></i><label for="name" class="pl-2 font-weight-bold">Name</label>
              <input type="text" class="form-control" placeholder="Name" name="rName" required>
            </div>
            <div class="form-group">
              <i class="fas fa-envelope"></i><label for="email" class="pl-2 font-weight-bold">Email</label>
              <input type="email" class="form-control" placeholder="Email" name="rEmail" required>
              <small class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
              <i class="fas fa-lock"></i><label for="pass" class="pl-2 font-weight-bold">New Password</label>
              <input type="password" class="form-control" placeholder="Password" name="rPassword" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block shadow-sm font-weight-bold mt-4">Sign Up</button>
            <small class="d-block text-center mt-3" style="font-size: 0.8rem;">By clicking Sign Up, you agree to our Terms, Data Policy, and Cookie Policy.</small>
            <?php if(isset($regmsg)) {echo $regmsg; } ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>