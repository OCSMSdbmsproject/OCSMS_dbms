<?php
define('TITLE', 'Dashboard');
define('PAGE', 'dashboard');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();
 if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
 } else {
  echo "<script> location.href='login.php'; </script>";
 }
 $sql = "SELECT max(request_id) FROM submitrequest_tb";
 $result = $conn->query($sql);
 $row = mysqli_fetch_row($result);
 $submitrequest = $row[0];

 $sql = "SELECT max(request_id) FROM assignwork_tb";
 $result = $conn->query($sql);
 $row = mysqli_fetch_row($result);
 $assignwork = $row[0];

 $sql = "SELECT * FROM technician_tb";
 $result = $conn->query($sql);
 $totaltech = $result->num_rows;

?>
<div class="col-sm-9 col-md-10">
  <div class="row mx-5 text-center">
    <div class="col-sm-4 mt-5">
      <div class="card text-white bg-danger mb-3 modern-card" style="max-width: 18rem;">
        <div class="card-header fw-bold">Requests Received</div>
        <div class="card-body">
          <h4 class="card-title"><?php echo $submitrequest; ?></h4>
          <a class="btn text-white btn-outline-light mt-2" href="request.php" style="border-radius: 30px;">View</a>
        </div>
      </div>
    </div>
    <div class="col-sm-4 mt-5">
      <div class="card text-white bg-success mb-3 modern-card" style="max-width: 18rem;">
        <div class="card-header fw-bold">Assigned Work</div>
        <div class="card-body">
          <h4 class="card-title"><?php echo $assignwork; ?></h4>
          <a class="btn text-white btn-outline-light mt-2" href="work.php" style="border-radius: 30px;">View</a>
        </div>
      </div>
    </div>
    <div class="col-sm-4 mt-5">
      <div class="card text-white bg-info mb-3 modern-card" style="max-width: 18rem;">
        <div class="card-header fw-bold">No. of Technicians</div>
        <div class="card-body">
          <h4 class="card-title"><?php echo $totaltech; ?></h4>
          <a class="btn text-white btn-outline-light mt-2" href="technician.php" style="border-radius: 30px;">View</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Table Section -->
  <div class="mx-5 mt-5 text-center">
    <p class="bg-dark text-white p-2 rounded-3">List of Requesters</p>
    <?php
    $sql = "SELECT * FROM requesterlogin_tb";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      echo '<div class="table-responsive">';
      echo '<table class="table table-striped table-hover align-middle">';
      echo '<thead class="table-dark">';
      echo '<tr>
            <th scope="col">Requester ID</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
          </tr>';
      echo '</thead>';
      echo '<tbody>';
      while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<th scope="row">' . $row["r_login_id"] . '</th>';
        echo '<td>' . $row["r_name"] . '</td>';
        echo '<td>' . $row["r_email"] . '</td>';
        echo '</tr>';
      }
      echo '</tbody>';
      echo '</table>';
      echo '</div>';
    } else {
      echo "<div class='alert alert-warning text-center'>No Result Found</div>";
    }
    ?>
  </div>
</div>
  </div>
</div>
</div>
</div>
<?php
include('includes/footer.php'); 
?>

<style>
  /* Card Hover Effects */
/* Card Hover Effects */
.modern-card {
    border-radius: 15px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    position: relative;
    overflow: hidden;
}

.modern-card:hover {
    transform: translateY(-10px) scale(1.05); /* Slight lift and enlarge effect */
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15); /* Stronger shadow on hover */
}

/* Gradient Effect */
.bg-danger {
    background: linear-gradient(145deg, #ff4b5c, #ff0066); /* Soft gradient */
}

.bg-success {
    background: linear-gradient(145deg, #28a745, #218838);
}

.bg-info {
    background: linear-gradient(145deg, #00c4cc, #17a2b8);
}

/* Button Styling */
.btn-outline-light {
    border-radius: 30px;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.btn-outline-light:hover {
    background-color: #fff;
    color: #333;
}

/* Table Row Hover Effect */
.table-hover tbody tr:hover {
    background-color: rgba(0, 0, 0, 0.05); /* Light hover background */
}

/* Card Header */
.card-header {
    background-color: rgba(0, 0, 0, 0.05);
    font-weight: bold;
}

/* Table Styling */
.table-hover tbody tr:hover {
    background-color: rgba(0, 0, 0, 0.05); /* Subtle hover effect on rows */
}

.table-striped tbody tr:nth-child(odd) {
    background-color: #f8f9fa; /* Light striping */
}


  </style>