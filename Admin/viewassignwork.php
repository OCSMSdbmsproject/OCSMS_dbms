<?php
define('TITLE', 'Work Order');
define('PAGE', 'work');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();
if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
} else {
  echo "<script> location.href='login.php'; </script>";
}
?>

<div class="col-sm-6 mt-5 mx-3">
  <h3 class="text-center text-modern">Assigned Work Details</h3>
  <?php
  if(isset($_REQUEST['view'])){
    $sql = "SELECT * FROM assignwork_tb WHERE request_id = {$_REQUEST['id']}";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
  }
  ?>
  <table class="table table-striped table-bordered table-modern">
    <tbody>
      <tr>
        <td>Request ID</td>
        <td><?php if(isset($row['request_id'])) {echo $row['request_id']; }?></td>
      </tr>
      <tr>
        <td>Request Info</td>
        <td><?php if(isset($row['request_info'])) {echo $row['request_info']; }?></td>
      </tr>
      <tr>
        <td>Request Description</td>
        <td><?php if(isset($row['request_desc'])) {echo $row['request_desc']; }?></td>
      </tr>
      <tr>
        <td>Name</td>
        <td><?php if(isset($row['requester_name'])) {echo $row['requester_name']; }?></td>
      </tr>
      <tr>
        <td>Address Line 1</td>
        <td><?php if(isset($row['requester_add1'])) {echo $row['requester_add1']; }?></td>
      </tr>
      <tr>
        <td>Address Line 2</td>
        <td><?php if(isset($row['requester_add2'])) {echo $row['requester_add2']; }?></td>
      </tr>
      <tr>
        <td>City</td>
        <td><?php if(isset($row['requester_city'])) {echo $row['requester_city']; }?></td>
      </tr>
      <tr>
        <td>State</td>
        <td><?php if(isset($row['requester_state'])) {echo $row['requester_state']; }?></td>
      </tr>
      <tr>
        <td>Pin Code</td>
        <td><?php if(isset($row['requester_zip'])) {echo $row['requester_zip']; }?></td>
      </tr>
      <tr>
        <td>Email</td>
        <td><?php if(isset($row['requester_email'])) {echo $row['requester_email']; }?></td>
      </tr>
      <tr>
        <td>Mobile</td>
        <td><?php if(isset($row['requester_mobile'])) {echo $row['requester_mobile']; }?></td>
      </tr>
      <tr>
        <td>Assigned Date</td>
        <td><?php if(isset($row['assign_date'])) {echo $row['assign_date']; }?></td>
      </tr>
      <tr>
        <td>Technician Name</td>
        <td><?php if(isset($row['assign_tech'])) {echo $row['assign_tech']; }?></td>
      </tr>
      <tr>
        <td>Customer Sign</td>
        <td></td>
      </tr>
      <tr>
        <td>Technician Sign</td>
        <td></td>
      </tr>
    </tbody>
  </table>
  <div class="text-center">
    <form class='d-print-none d-inline mr-3'>
      <input class='btn btn-danger custom-btn' type='submit' value='Print' onClick='window.print()'>
    </form>
    <form class='d-print-none d-inline' action="work.php">
      <input class='btn btn-secondary custom-btn' type='submit' value='Close'>
    </form>
  </div>
</div>

<?php
include('includes/footer.php'); 
?>
<style>
    /* Table Styling */
.table-modern {
    font-family: 'Arial', sans-serif;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
    background-color: #ffffff;
}

.table-modern td, .table-modern th {
    padding: 15px;
    text-align: left;
}

.table-striped tbody tr:nth-child(odd) {
    background-color: #f9f9f9;
}

.table-bordered td, .table-bordered th {
    border: 1px solid #ddd;
}

.table-modern tr:hover {
    background-color: rgba(0, 0, 0, 0.05);
    transform: scale(1.02);
    transition: all 0.3s ease;
}

/* Table Header Styling */
thead {
    background-color: #343a40;
    color: white;
    font-weight: bold;
    text-align: center;
}

/* Modern Title */
.text-modern {
    font-family: 'Arial', sans-serif;
    color: #333;
    font-weight: bold;
    margin-bottom: 20px;
    text-transform: uppercase;
}

/* Button Styling */
.custom-btn {
    border-radius: 30px;
    padding: 10px 30px;
    transition: all 0.3s ease;
    font-weight: bold;
}

.custom-btn:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.btn-danger {
    background-color: #dc3545;
    border: none;
}

.btn-danger:hover {
    background-color: #c82333;
}

.btn-secondary {
    background-color: #6c757d;
    border: none;
}

.btn-secondary:hover {
    background-color: #5a6268;
}

/* Form Styling */
form {
    display: inline-block;
    margin-right: 10px;
}

/* Print and Close Buttons */
.d-print-none {
    margin-top: 20px;
}

.text-center {
    text-align: center;
    margin-top: 30px;
}

/* Styling for input fields and select options */
input[type="text"], input[type="number"], select {
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ddd;
    margin-bottom: 10px;
    width: 100%;
    font-size: 16px;
    transition: all 0.3s ease;
}

input[type="text"]:focus, input[type="number"]:focus, select:focus {
    border-color: #0056b3;
    outline: none;
}

/* Responsive Styling */
@media (max-width: 768px) {
    .col-sm-6 {
        width: 100%;
    }
}

    </style>