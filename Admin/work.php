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
<div class="col-sm-9 col-md-10 mt-5">
  <?php 
  $sql = "SELECT * FROM assignwork_tb";
  $result = $conn->query($sql);
  if($result->num_rows > 0){
    echo '<table class="table table-striped table-hover table-bordered">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Req ID</th>
        <th scope="col">Request Info</th>
        <th scope="col">Name</th>
        <th scope="col">Address</th>
        <th scope="col">City</th>
        <th scope="col">Mobile</th>
        <th scope="col">Technician</th>
        <th scope="col">Assigned Date</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>';
    while($row = $result->fetch_assoc()){
      echo '<tr>
      <th scope="row">'.$row["request_id"].'</th>
      <td>'.$row["request_info"].'</td>
      <td>'.$row["requester_name"].'</td>
      <td>'.$row["requester_add2"].'</td>
      <td>'.$row["requester_city"].'</td>
      <td>'.$row["requester_mobile"].'</td>
      <td>'.$row["assign_tech"].'</td>
      <td>'.$row["assign_date"].'</td>
      <td>
        <form action="viewassignwork.php" method="POST" class="d-inline">
          <input type="hidden" name="id" value='. $row["request_id"] .'>
          <button type="submit" class="btn btn-warning custom-btn" name="view" value="View">
            <i class="far fa-eye"></i> View
          </button>
        </form>
        <form action="" method="POST" class="d-inline">
          <input type="hidden" name="id" value='. $row["request_id"] .'>
          <button type="submit" class="btn btn-danger custom-btn" name="delete" value="Delete">
            <i class="far fa-trash-alt"></i> Delete
          </button>
        </form>
      </td>
      </tr>';
    }
    echo '</tbody></table>';
  } else {
    echo "<div class='alert alert-warning'>No Records Found</div>";
  }

  if(isset($_REQUEST['delete'])){
    $sql = "DELETE FROM assignwork_tb WHERE request_id = {$_REQUEST['id']}";
    if($conn->query($sql) === TRUE){
      echo '<meta http-equiv="refresh" content= "0;URL=?deleted" />';
    } else {
      echo "<div class='alert alert-danger'>Unable to Delete Data</div>";
    }
  }
  ?>
</div>
</div>
</div>

<?php
include('includes/footer.php'); 
?>
<style>
  /* Table Styling */
.table {
    font-family: 'Arial', sans-serif;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
}

.table thead {
    background-color: #343a40;
    color: white;
    font-weight: bold;
}

.table th, .table td {
    text-align: center;
    vertical-align: middle;
}

.table tbody tr:hover {
    background-color: rgba(0, 0, 0, 0.05); /* Subtle hover effect */
    transform: scale(1.02); /* Slightly scale up rows on hover */
    transition: all 0.3s ease;
}

.table-striped tbody tr:nth-child(odd) {
    background-color: #f9f9f9;
}

.table-bordered td, .table-bordered th {
    border: 1px solid #ddd;
}

/* Button Styling */
.custom-btn {
    border-radius: 30px;
    padding: 8px 20px;
    transition: all 0.3s ease;
    font-weight: bold;
}

.custom-btn:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

/* Specific Button Colors */
.btn-warning {
    background-color: #ffc107;
    border: none;
}

.btn-warning:hover {
    background-color: #e0a800;
}

.btn-danger {
    background-color: #dc3545;
    border: none;
}

.btn-danger:hover {
    background-color: #c82333;
}

/* Alert Styling for Messages */
.alert {
    font-weight: bold;
    border-radius: 5px;
    padding: 15px;
}

.alert-warning {
    background-color: #f0ad4e;
    color: white;
}

.alert-danger {
    background-color: #d9534f;
    color: white;
}

/* Form Styling */
form {
    display: inline-block;
    margin-right: 10px;
}

/* Enhance the page title and spacing */
h1 {
    font-family: 'Arial', sans-serif;
    color: #343a40;
    font-weight: bold;
    margin-bottom: 20px;
}

  </style>