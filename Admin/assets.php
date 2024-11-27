<?php
define('TITLE', 'Assets');
define('PAGE', 'assets');
include('includes/header.php');
include('../dbConnection.php'); 
session_start();
if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
} else {
  echo "<script> location.href='login.php'; </script>";
}
?>

<div class="col-sm-9 col-md-10 mt-5 text-center">
  <!-- Header for the table -->
  <h3 class="text-center text-primary">Product/Parts Details</h3>
  
  <?php
    $sql = "SELECT * FROM assets_tb";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
      echo '<table class="table table-striped table-bordered shadow-lg rounded">';
      echo '<thead class="thead-dark">
              <tr>
                <th scope="col">Product ID</th>
                <th scope="col">Name</th>
                <th scope="col">DOP</th>
                <th scope="col">Available</th>
                <th scope="col">Total</th>
                <th scope="col">Original Cost Each</th>
                <th scope="col">Selling Price Each</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>';
      
      while($row = $result->fetch_assoc()){
        echo '<tr>
                <th scope="row">'.$row["pid"].'</th>
                <td>'.$row["pname"].'</td>
                <td>'.$row["pdop"].'</td>
                <td>'.$row["pava"].'</td>
                <td>'.$row["ptotal"].'</td>
                <td>'.$row["poriginalcost"].'</td>
                <td>'.$row["psellingcost"].'</td>
                <td>
                  <form action="editproduct.php" method="POST" class="d-inline"> 
                    <input type="hidden" name="id" value='. $row["pid"] .'>
                    <button type="submit" class="btn btn-info" name="view" value="View"><i class="fas fa-pen"></i></button>
                  </form>
                  <form action="" method="POST" class="d-inline">
                    <input type="hidden" name="id" value='. $row["pid"] .'>
                    <button type="submit" class="btn btn-danger" name="delete" value="Delete"><i class="far fa-trash-alt"></i></button>
                  </form>
                  <form action="sellproduct.php" method="POST" class="d-inline">
                    <input type="hidden" name="id" value='. $row["pid"] .'>
                    <button type="submit" class="btn btn-success" name="issue" value="Issue"><i class="fas fa-handshake"></i></button>
                  </form>
                </td>
              </tr>';
      }
      echo '</tbody></table>';
    } else {
      echo '<div class="alert alert-info mt-3">No assets found in the system.</div>';
    }
    
    // Deleting asset record
    if(isset($_REQUEST['delete'])){
      $sql = "DELETE FROM assets_tb WHERE pid = {$_REQUEST['id']}";
      if($conn->query($sql) === TRUE){
        echo '<meta http-equiv="refresh" content= "0;URL=?deleted" />';
      } else {
        echo "Unable to Delete Data";
      }
    }
  ?>
</div>

<!-- Floating Add Product Button -->
<a class="btn btn-danger box" href="addproduct.php"><i class="fas fa-plus fa-2x"></i></a>

<?php
include('includes/footer.php'); 
?>

<style>
/* General Body Styling */
body {
    font-family: 'Poppins', sans-serif;
    background-color: #f8f9fa;
}

/* Table Design */
.table {
    margin-top: 20px;
    font-size: 14px;
    border-collapse: separate;
    border-spacing: 0 10px;
}

.table th, .table td {
    padding: 15px;
    text-align: center;
    vertical-align: middle;
}

/* Header Row Style */
.table thead {
    background-color: #007bff;
    color: white;
    border-radius: 8px;
}

.table thead th {
    font-weight: bold;
    font-size: 16px;
}

/* Row Hover Effects */
.table tbody tr:hover {
    background-color: #e9f7fd;
    cursor: pointer;
    transition: all 0.3s ease;
    transform: scale(1.02);
}

.table tbody tr:nth-child(even) {
    background-color: #f8f9fa;
}

/* Buttons */
.btn-info, .btn-danger, .btn-success {
    border-radius: 50px;
    padding: 8px 15px;
    font-size: 14px;
    font-weight: 600;
    box-shadow: 0px 4px 6px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.btn-info:hover {
    background-color: #138496;
    transform: scale(1.05);
}

.btn-danger:hover {
    background-color: #c82333;
    transform: scale(1.05);
}

.btn-success:hover {
    background-color: #218838;
    transform: scale(1.05);
}

/* Floating Add Product Button */
.box {
    position: fixed;
    bottom: 40px;
    right: 30px;
    z-index: 1000;
    background-color: #dc3545;
    border-radius: 50%;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
}

.box:hover {
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
}

.box i {
    color: white;
}

/* Table Shadow */
.table-striped {
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

/* Alert Box Styling */
.alert-info {
    font-size: 16px;
    background-color: #f1f8ff;
    color: #007bff;
    padding: 15px;
    border-radius: 8px;
}

/* Text Styling for Headings */
h3 {
    font-size: 24px;
    font-weight: 700;
    color: #007bff;
    margin-bottom: 20px;
}


  </style>