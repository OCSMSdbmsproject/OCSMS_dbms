<?php
define('TITLE', 'Requests');
define('PAGE', 'request');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();
if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
} else {
  echo "<script> location.href='login.php'; </script>";
}
?>
<div class="col-sm-4 mb-5">
  <!-- Main Content area start Middle -->
  <?php 
  $sql = "SELECT request_id, request_info, request_desc, request_date FROM submitrequest_tb";
  $result = $conn->query($sql);
  if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      echo '<div class="card mt-5 mx-5 shadow-lg card-custom">';
      echo '<div class="card-header card-header-custom">';
      echo 'Request ID : '. $row['request_id'];
      echo '</div>';
      echo '<div class="card-body card-body-custom">';
      echo '<h5 class="card-title text-dark">Request Info : ' . $row['request_info'] . '</h5>';
      echo '<p class="card-text text-muted">' . $row['request_desc'] . '</p>';
      echo '<p class="card-text text-dark">Request Date: ' . $row['request_date'] . '</p>';
      echo '<div class="float-right">';
      echo '<form action="" method="POST"> 
              <input type="hidden" name="id" value='. $row["request_id"] .'>
              <input type="submit" class="btn btn-modern mr-3 btn-view" name="view" value="View">
              <input type="submit" class="btn btn-modern btn-close" name="close" value="Close">
            </form>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
    }
  } else {
    echo '<div class="alert alert-info mt-5 col-sm-6" role="alert">
            <h4 class="alert-heading">Well done!</h4>
            <p>Aww yeah, you successfully assigned all Requests.</p>
            <hr>
            <h5 class="mb-0">No Pending Requests</h5>
          </div>';
  }

  // after assigning work we will delete data from submitrequesttable by pressing close button
  if(isset($_REQUEST['close'])){
    $sql = "DELETE FROM submitrequest_tb WHERE request_id = {$_REQUEST['id']}";
    if($conn->query($sql) === TRUE){
      echo '<meta http-equiv="refresh" content= "0;URL=?closed" />';
    } else {
      echo "Unable to Delete Data";
    }
  }
  ?>
</div> <!-- Main Content area End Middle -->

<?php 
  include('assignworkform.php');
  include('includes/footer.php'); 
  $conn->close();
?>
<style>
/* General Styles */
/* General Styles */
body {
    font-family: 'Roboto', sans-serif;
    /* Removed background-color */
}

/* Card Styling */
.card-custom {
    border-radius: 12px;
    border: none;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    background-color: #ffffff;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    margin-bottom: 30px;
}

.card-custom:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
}

/* Card Header Styling */
.card-header-custom {
    background-color: #a3c8f0; /* Lightish Blue color for Request ID */
    color: #ffffff;
    font-size: 18px;
    font-weight: bold;
    padding: 12px;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
}

/* Card Body Styling */
.card-body-custom {
    font-size: 16px;
    padding: 20px;
    color: #444;
}

.card-title {
    font-size: 20px;
    font-weight: bold;
    color: #333;
}

.card-text {
    font-size: 14px;
    color: #555;
}

.float-right {
    float: right;
}

/* Button Styling for "View" Button - Red color */
.btn-view {
    border-radius: 30px;
    padding: 10px 20px;
    font-weight: bold;
    background-color: #dc3545; /* Red color */
    color: #fff;
    border: none;
    transition: all 0.3s ease;
}

.btn-view:hover {
    background-color: #c82333; /* Darker red shade on hover */
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    transform: scale(1.05);
}

/* Button Styling for "Close" Button - Light Blue Color */
.btn-close {
    background-color: #66b3ff; /* Light Blue color */
    color: #fff;
    border: none;
    border-radius: 30px;
    padding: 10px 20px;
    font-weight: bold;
    transition: all 0.3s ease;
}

.btn-close:hover {
    background-color: #3399ff; /* Slightly darker blue on hover */
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    transform: scale(1.05);
}

/* Alert Box Styling */
.alert-info {
    font-size: 16px;
    padding: 20px;
    border-radius: 8px;
    background-color: #e9f7fd;
    border-color: #b8daff;
    color: #31708f;
}

.alert-info .alert-heading {
    font-size: 18px;
    font-weight: bold;
}

/* Card Hover Effect */
.card-custom:hover {
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transform: translateY(-10px);
}

/* Responsive Design */
@media (max-width: 768px) {
    .col-sm-4 {
        width: 100%;
        margin-bottom: 20px;
    }

    .card-custom {
        margin: 10px;
    }
}

</style>