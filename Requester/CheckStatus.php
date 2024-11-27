<?php
define('TITLE', 'Status');
define('PAGE', 'CheckStatus');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();
if($_SESSION['is_login']){
  $rEmail = $_SESSION['rEmail'];
} else {
  echo "<script> location.href='RequesterLogin.php'; </script>";
}
?>

<div class="col-sm-6 mt-5 mx-auto">
  <!-- Form for entering Request ID -->
  <form action="" class="mt-5 form-inline d-print-none justify-content-center"> <!-- Increased margin-top for more space -->
    <div class="form-group mr-3">
      <label for="checkid" class="mr-2 text-lg">Enter Request ID: </label>
      <input type="text" class="form-control ml-3" id="checkid" name="checkid" onkeypress="isInputNumber(event)" placeholder="Enter ID" style="background-color: #f0f8ff; font-size: 18px;">
    </div>
    <button type="submit" class="btn custom-button ml-3">Search</button>
  </form>

  <?php
  if(isset($_REQUEST['checkid'])){
    $sql = "SELECT * FROM assignwork_tb WHERE request_id = {$_REQUEST['checkid']}";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if(($row['request_id']) == $_REQUEST['checkid']){ ?>
  <h3 class="text-center mt-5">Assigned Work Details</h3>
  <table class="table table-bordered">
    <tbody>
      <!-- Display Request Details -->
      <tr><td>Request ID</td><td><?php echo $row['request_id']; ?></td></tr>
      <tr><td>Request Info</td><td><?php echo $row['request_info']; ?></td></tr>
      <tr><td>Request Description</td><td><?php echo $row['request_desc']; ?></td></tr>
      <tr><td>Name</td><td><?php echo $row['requester_name']; ?></td></tr>
      <tr><td>Address Line 1</td><td><?php echo $row['requester_add1']; ?></td></tr>
      <tr><td>Address Line 2</td><td><?php echo $row['requester_add2']; ?></td></tr>
      <tr><td>City</td><td><?php echo $row['requester_city']; ?></td></tr>
      <tr><td>State</td><td><?php echo $row['requester_state']; ?></td></tr>
      <tr><td>Pin Code</td><td><?php echo $row['requester_zip']; ?></td></tr>
      <tr><td>Email</td><td><?php echo $row['requester_email']; ?></td></tr>
      <tr><td>Mobile</td><td><?php echo $row['requester_mobile']; ?></td></tr>
      <tr><td>Assigned Date</td><td><?php echo $row['assign_date']; ?></td></tr>
      <tr><td>Technician Name</td><td><?php echo $row['assign_tech']; ?></td></tr>
      <tr><td>Customer Sign</td><td></td></tr>
      <tr><td>Technician Sign</td><td></td></tr>
    </tbody>
  </table>
  <div class="text-center">
    <form class="d-print-none d-inline mr-3"><input class="btn btn-danger" type="submit" value="Print" onClick="window.print()"></form>
    <form class="d-print-none d-inline" action="work.php"><input class="btn btn-secondary" type="submit" value="Close"></form>
  </div>
  <?php } else {
    echo '<div class="alert alert-dark mt-4" role="alert">Your Request is Still Pending</div>';
    }
  }
  ?>
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

<style>
  /* Custom CSS */
  body {
    background-color: #f4f4f9; /* Light background color */
  }

  .form-control {
    width: 75%; /* Adjust input width */
    font-size: 18px; /* Increase font size of input */
    border-radius: 8px;
  }

  .custom-button {
    background-color: #007bff; /* Light blue color for search button */
    color: white; /* White text */
    border: none;
    font-size: 18px; /* Increase font size of button */
    border-radius: 8px;
    padding: 10px 20px;
    transition: background-color 0.3s ease;
  }

  .custom-button:hover {
    background-color: #87CEEB; /* Darker blue on hover */
  }

  .alert {
    background-color: #f9f9f9;
    border-color: #d6d6d6;
  }

  .table-bordered {
    border: 2px solid #ddd;
  }

  .table td {
    padding: 10px;
    font-size: 16px;
  }

  .form-inline {
    margin-top: 120px; /* Increased margin-top for more space from navbar */
  }

  .form-group label {
    font-size: 20px; /* Increase font size of label */
  }

  .form-control::placeholder {
    color: #7f7f7f; /* Lighter color for placeholder */
  }
</style>

<?php
include('includes/footer.php');
?>


