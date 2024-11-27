<?php    
define('TITLE', 'Update Product');
define('PAGE', 'assets');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();
if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
} else {
  echo "<script> location.href='login.php'; </script>";
}

// Update Product
if(isset($_REQUEST['pupdate'])){
  // Checking for Empty Fields
  if(($_REQUEST['pname'] == "") || ($_REQUEST['pdop'] == "") || ($_REQUEST['pava'] == "") || ($_REQUEST['ptotal'] == "") || ($_REQUEST['poriginalcost'] == "") || ($_REQUEST['psellingcost'] == "")){
    // msg displayed if required field missing
    $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fields </div>';
  } else {
    // Assigning User Values to Variable
    $pid = $_REQUEST['pid'];
    $pname = $_REQUEST['pname'];
    $pdop = $_REQUEST['pdop'];
    $pava = $_REQUEST['pava'];
    $ptotal = $_REQUEST['ptotal'];
    $poriginalcost = $_REQUEST['poriginalcost'];
    $psellingcost = $_REQUEST['psellingcost'];
    $sql = "UPDATE assets_tb SET pname = '$pname', pdop = '$pdop', pava = '$pava', ptotal = '$ptotal', poriginalcost = '$poriginalcost', psellingcost = '$psellingcost' WHERE pid = '$pid'";
    if($conn->query($sql) == TRUE){
      // success message
      $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Updated Successfully </div>';
    } else {
      // error message
      $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update </div>';
    }
  }
}
?>
<div class="col-sm-6 mt-5 mx-3 jumbotron shadow-lg rounded p-4" style="background-color: #f9f9f9;">
  <h3 class="text-center text-primary">Update Product Details</h3>
  <?php
  if(isset($_REQUEST['view'])){
    $sql = "SELECT * FROM assets_tb WHERE pid = {$_REQUEST['id']}";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
  }
  ?>
  <form action="" method="POST">
    <div class="form-group">
      <label for="pid">Product ID</label>
      <input type="text" class="form-control" id="pid" name="pid" value="<?php if(isset($row['pid'])) {echo $row['pid']; }?>" readonly>
    </div>
    <div class="form-group">
      <label for="pname">Name</label>
      <input type="text" class="form-control" id="pname" name="pname" value="<?php if(isset($row['pname'])) {echo $row['pname']; }?>">
    </div>
    <div class="form-group">
      <label for="pdop">Date of Purchase</label>
      <input type="date" class="form-control" id="pdop" name="pdop" value="<?php if(isset($row['pdop'])) {echo $row['pdop']; }?>">
    </div>
    <div class="form-group">
      <label for="pava">Available Quantity</label>
      <input type="text" class="form-control" id="pava" name="pava" value="<?php if(isset($row['pava'])) {echo $row['pava']; }?>" onkeypress="isInputNumber(event)">
    </div>
    <div class="form-group">
      <label for="ptotal">Total Quantity</label>
      <input type="text" class="form-control" id="ptotal" name="ptotal" value="<?php if(isset($row['ptotal'])) {echo $row['ptotal']; }?>" onkeypress="isInputNumber(event)">
    </div>
    <div class="form-group">
      <label for="poriginalcost">Original Cost (Each)</label>
      <input type="text" class="form-control" id="poriginalcost" name="poriginalcost" value="<?php if(isset($row['poriginalcost'])) {echo $row['poriginalcost']; }?>" onkeypress="isInputNumber(event)">
    </div>
    <div class="form-group">
      <label for="psellingcost">Selling Price (Each)</label>
      <input type="text" class="form-control" id="psellingcost" name="psellingcost" value="<?php if(isset($row['psellingcost'])) {echo $row['psellingcost']; }?>" onkeypress="isInputNumber(event)">
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-danger btn-lg" id="pupdate" name="pupdate">Update</button>
      <a href="assets.php" class="btn btn-secondary btn-lg">Close</a>
    </div>
    <?php if(isset($msg)) {echo $msg; } ?>
  </form>
</div>

<!-- Only Number for input fields -->
<script>
  function isInputNumber(evt) {
    var ch = String.fromCharCode(evt.which);
    if (!(/[0-9]/.test(ch))) {
      evt.preventDefault();
    }
  }
</script>

<?php
include('includes/footer.php'); 
?>
<style>
  /* Form Styling */
.jumbotron {
    background-color: #f9f9f9 !important;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
}

/* Heading Style */
h3.text-center {
    font-size: 26px;
    color: #007bff;
    font-weight: 600;
}

/* Input Fields */
.form-control {
    border-radius: 8px;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: border-color 0.3s ease;
}

.form-control:focus {
    border-color: #007bff;
    box-shadow: 0px 0px 5px rgba(0, 123, 255, 0.5);
}

/* Button Styling */
.btn {
    border-radius: 50px;
    padding: 10px 25px;
    font-weight: 600;
    font-size: 16px;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

/* Alert Boxes */
.alert {
    font-size: 16px;
    border-radius: 8px;
    margin-top: 10px;
}

/* Button size adjustment for Close and Update */
.btn-lg {
    padding: 12px 30px;
}

/* Number Input Styling */
input[type="text"]:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

input[type="date"]:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

/* Success & Error Messages */
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