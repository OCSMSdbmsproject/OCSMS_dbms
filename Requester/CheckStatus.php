<?php
define('TITLE', 'Status');
define('PAGE', 'CheckStatus');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();

// Check if the user is logged in
if ($_SESSION['is_login']) {
    $rEmail = $_SESSION['rEmail'];
} else {
    echo "<script> location.href='RequesterLogin.php'; </script>";
    exit;
}
?>

<div class="col-sm-6 mt-5 mx-auto">
  <!-- Form for entering Request ID -->
  <form action="" class="mt-5 form-inline d-print-none justify-content-center">
    <div class="form-group mr-3">
      <label for="checkid" class="mr-2 text-lg">Enter Request ID: </label>
      <input type="text" class="form-control ml-3" id="checkid" name="checkid" 
             onkeypress="isInputNumber(event)" placeholder="Enter ID" 
             style="background-color: #f0f8ff; font-size: 18px;">
    </div>
    <button type="submit" class="btn custom-button ml-3">Search</button>
  </form>

  <?php
  if (isset($_REQUEST['checkid'])) {
      $requestId = trim($_REQUEST['checkid']); // Sanitize input

      if (empty($requestId)) {
          echo '<div class="alert alert-warning mt-4" role="alert">Please enter a Request ID.</div>';
      } else {
          // Check if the request_id exists in assignwork_tb
          $sqlAssign = "SELECT * FROM assignwork_tb WHERE request_id = ?";
          $stmtAssign = $conn->prepare($sqlAssign);
          $stmtAssign->bind_param("i", $requestId);
          $stmtAssign->execute();
          $resultAssign = $stmtAssign->get_result();

          if ($resultAssign->num_rows > 0) {
              // Request exists in assignwork_tb
              $row = $resultAssign->fetch_assoc();
              ?>
              <h3 class="text-center mt-5">Assigned Work Details</h3>
              <table class="table table-bordered">
                  <tbody>
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
                  </tbody>
              </table>
              <div class="text-center">
                  <form class="d-print-none d-inline mr-3">
                      <input class="btn btn-danger" type="submit" value="Print" onClick="window.print()">
                  </form>
                  <form class="d-print-none d-inline" action="work.php">
                      <input class="btn btn-secondary" type="submit" value="Close">
                  </form>
              </div>
              <?php
          } else {
              // Check if the request_id exists in submitrequest_tb
              $sqlSubmit = "SELECT * FROM submitrequest_tb WHERE request_id = ?";
              $stmtSubmit = $conn->prepare($sqlSubmit);
              $stmtSubmit->bind_param("i", $requestId);
              $stmtSubmit->execute();
              $resultSubmit = $stmtSubmit->get_result();

              if ($resultSubmit->num_rows > 0) {
                  // Found in submitrequest_tb but not in assignwork_tb
                  echo '<div class="alert alert-info mt-4" role="alert">Your work is still pending.</div>';
              } else {
                  // Not found in either table
                  echo '<div class="alert alert-danger mt-4" role="alert">Enter a valid Request ID.</div>';
              }
          }
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
    background-color: #d8f3fc; /* Light blue background color (same as the profile background) */
  }

  .form-control {
    width: 75%; /* Adjust input width */
    font-size: 18px; /* Increase font size of input */
    border-radius: 8px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1); /* Subtle shadow for input box */
    transition: border 0.3s ease, box-shadow 0.3s ease;
    padding: 10px;
  }

  /* Highlighting the Request ID input box when focused */
  .form-control:focus {
    border-color: #0056b3; /* Blue border on focus */
    box-shadow: 0 0 10px rgba(0, 86, 179, 0.6); /* Stronger blue shadow */
    outline: none;
  }

  /* Adding a subtle animation to the input box to attract attention */
  .form-control:focus, .form-control:hover {
    animation: pulse 1s infinite; /* Pulse effect on focus and hover */
  }

  /* Pulse animation to highlight the input box */
  @keyframes pulse {
    0% {
      transform: scale(1);
      box-shadow: 0 0 10px rgba(0, 123, 255, 0.6);
    }
    50% {
      transform: scale(1.05);
      box-shadow: 0 0 15px rgba(0, 123, 255, 0.9);
    }
    100% {
      transform: scale(1);
      box-shadow: 0 0 10px rgba(0, 123, 255, 0.6);
    }
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
    background-color: #0056b3; /* Darker blue on hover */
  }

  /* Change print button color to dark blue */
  .print-button {
    background-color: #0056b3; /* Dark blue color for print button */
    color: white;
    font-size: 16px;
    border-radius: 8px;
    padding: 10px 20px;
    transition: background-color 0.3s ease;
  }

  .print-button:hover {
    background-color: #003f7f; /* Darker blue on hover */
  }

  .alert {
    background-color: #f9f9f9;
    border-color: #d6d6d6;
  }

  /* Custom Assigned Work Box Styling */
  .assigned-work-box {
    background-color: #ffffff; /* White background for better contrast */
    border: 2px solid #0056b3; /* Dark blue border for visibility */
    padding: 20px; /* Add padding inside the box */
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Soft shadow to make it appear elevated */
    margin-top: 30px; /* Space between form and the table */
  }

  .table-bordered {
    border: 2px solid #ddd;
  }

  .table td {
    padding: 10px;
    font-size: 16px;
  }

  .table th {
    background-color: #0056b3; /* Dark blue background for header */
    color: white; /* White text for better contrast */
    font-size: 18px;
  }

  /* Hover effect for table rows */
  .table tbody tr:hover {
    background-color: #f1f1f1; /* Light grey color on row hover */
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
