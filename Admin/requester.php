<?php
define('TITLE', 'Requesters');
define('PAGE', 'requesters');
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
  <!-- Table -->
  <p class="bg-dark text-white p-3 mb-4 rounded shadow-lg">List of Requesters</p>
  <?php
    $sql = "SELECT * FROM requesterlogin_tb";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
      echo '<table class="table table-hover table-bordered table-striped">
              <thead>
                <tr>
                  <th scope="col">Requester ID</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>';
      while($row = $result->fetch_assoc()){
        echo '<tr>';
        echo '<th scope="row">'.$row["r_login_id"].'</th>';
        echo '<td>'. $row["r_name"].'</td>';
        echo '<td>'.$row["r_email"].'</td>';
        echo '<td>
                <form action="editreq.php" method="POST" class="d-inline">
                  <input type="hidden" name="id" value='. $row["r_login_id"] .'>
                  <button type="submit" class="btn btn-info mr-2" name="view" value="View"><i class="fas fa-pen"></i> Edit</button>
                </form>
                <form action="" method="POST" class="d-inline">
                  <input type="hidden" name="id" value='. $row["r_login_id"] .'>
                  <button type="submit" class="btn btn-danger" name="delete" value="Delete"><i class="far fa-trash-alt"></i> Delete</button>
                </form>
              </td>';
        echo '</tr>';
      }
      echo '</tbody>
            </table>';
    } else {
      echo "<p class='text-danger'>No Requesters Found</p>";
    }
    if(isset($_REQUEST['delete'])){
      $sql = "DELETE FROM requesterlogin_tb WHERE r_login_id = {$_REQUEST['id']}";
      if($conn->query($sql) === TRUE){
        echo '<meta http-equiv="refresh" content="0;URL=?deleted" />';
      } else {
        echo "<p class='text-danger'>Unable to Delete Data</p>";
      }
    }
  ?>
</div>

<!-- Add Requester Button -->
<div class="text-center mt-3">
  <a href="insertreq.php" class="btn btn-red btn-lg rounded-circle box shadow-lg">
    <i class="fas fa-plus fa-2x"></i>
  </a>
</div>

<?php
include('includes/footer.php'); 
?>
<style>
  /* General Table Styling */
table {
  font-size: 16px;
  width: 100%;
  margin-top: 30px;
}

table th, table td {
  padding: 12px;
  text-align: center;
}

.table-hover tbody tr:hover {
  background-color: #f1f1f1;
  transition: background-color 0.3s ease;
}

.table-bordered {
  border: 1px solid #ddd;
}

/* Heading Style */
.bg-dark {
  background-color: #343a40 !important;
  padding: 20px;
  font-size: 22px;
  border-radius: 10px;
  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

/* Button Styling */
.btn-info, .btn-danger {
  border-radius: 8px;
  padding: 10px 20px;
  font-weight: 600;
  font-size: 14px;
  transition: all 0.3s ease;
}

.btn-info:hover, .btn-danger:hover {
  background-color: #0056b3;
  transform: scale(1.05);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

/* Red Add Requester Button */
.btn-red {
  background-color: red; /* Red color for the button */
  border-radius: 50%;
  padding: 20px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

.btn-red:hover {
  background-color: darkred; /* Dark red color on hover */
  transform: scale(1.1);
  box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
}

/* Styling for Text */
.text-danger {
  font-size: 18px;
  color: red;
  font-weight: bold;
  margin-top: 20px;
}

/* Responsiveness */
@media (max-width: 767px) {
  .table th, .table td {
    font-size: 14px;
  }
  .btn-info, .btn-danger {
    padding: 8px 16px;
    font-size: 12px;
  }
}
</style>