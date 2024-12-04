<?php
define('TITLE', 'Technician');
define('PAGE', 'technician');
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
  <p class="bg-dark text-white p-3 mb-4 rounded shadow-lg">List of Technicians</p>
  <?php
    $sql = "SELECT * FROM technician_tb";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
      echo '<table class="table table-hover table-bordered table-striped">
              <thead>
                <tr>
                  <th scope="col">Emp ID</th>
                  <th scope="col">Name</th>
                  <th scope="col">City</th>
                  <th scope="col">Mobile</th>
                  <th scope="col">Email</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>';
      while($row = $result->fetch_assoc()){
        echo '<tr>';
        echo '<th scope="row">'.$row["empid"].'</th>';
        echo '<td>'. $row["empName"].'</td>';
        echo '<td>'.$row["empCity"].'</td>';
        echo '<td>'.$row["empMobile"].'</td>';
        echo '<td>'.$row["empEmail"].'</td>';
        echo '<td>
                <form action="editemp.php" method="POST" class="d-inline">
                  <input type="hidden" name="id" value='. $row["empid"] .'>
                  <button type="submit" class="btn btn-info mr-2" name="view" value="View"><i class="fas fa-pen"></i> Edit</button>
                </form>
                <form action="" method="POST" class="d-inline">
                  <input type="hidden" name="id" value='. $row["empid"] .'>
                  <button type="submit" class="btn btn-danger" name="delete" value="Delete"><i class="far fa-trash-alt"></i> Delete</button>
                </form>
              </td>';
        echo '</tr>';
      }
      echo '</tbody>
            </table>';
    } else {
      echo "<p class='text-danger'>No Technicians Found</p>";
    }
    if(isset($_REQUEST['delete'])){
      $sql = "DELETE FROM technician_tb WHERE empid = {$_REQUEST['id']}";
      if($conn->query($sql) === TRUE){
        echo '<meta http-equiv="refresh" content="0;URL=?deleted" />';
      } else {
        echo "<p class='text-danger'>Unable to Delete Data</p>";
      }
    }
  ?>
</div>

<!-- Add Technician Button -->
<div class="text-center mt-3">
  <a href="insertemp.php" class="btn btn-success btn-lg rounded-circle box shadow-lg">
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

  /* Add Technician Button (Updated) */
  .btn-success {
    background-color: #dc3545; /* Red color */
    border-radius: 50%;
    padding: 15px; /* Slightly smaller padding */
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    color: #fff; /* Ensure text/icon is white */
    transition: all 0.3s ease;
  }

  .btn-success:hover {
    background-color: #dc3545 !important; /* Keep the button red on hover */
    transform: scale(1.1);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
  }

  /* Icon size and color */
  .btn-success i {
    font-size: 2rem; /* Larger icon size */
    color: #fff; /* Icon color to match the button */
  }

  /* Hover effect on icon */
  .btn-success:hover i {
    color: #fff; /* Keep the icon white on hover */
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