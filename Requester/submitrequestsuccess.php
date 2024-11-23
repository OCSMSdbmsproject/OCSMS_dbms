<?php
define('TITLE', 'Success');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();

// Check if user is logged in
if (!isset($_SESSION['is_login'])) {
    echo "<script> location.href='RequesterLogin.php'; </script>";
    exit;
}

$rEmail = $_SESSION['rEmail'];

// Validate that `myid` exists in the session
if (!isset($_SESSION['myid'])) {
    echo "<div class='alert alert-danger mt-5'>No request ID found. Please try submitting a new request.</div>";
    exit;
}

$request_id = $_SESSION['myid'];

// Retrieve request details using prepared statement
$sql = "SELECT * FROM submitrequest_tb WHERE request_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $request_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    // Display the details in a table
    echo "
    <div class='ml-5 mt-5'>
      <h3 class='text-center'>Request Submitted Successfully</h3>
      <table class='table table-bordered'>
        <tbody>
          <tr><th>Request ID</th><td>{$row['request_id']}</td></tr>
          <tr><th>Name</th><td>{$row['requester_name']}</td></tr>
          <tr><th>Email ID</th><td>{$row['requester_email']}</td></tr>
          <tr><th>Mobile</th><td>{$row['requester_mobile']}</td></tr>
          <tr><th>Address Line 1</th><td>{$row['requester_add1']}</td></tr>
          <tr><th>Address Line 2</th><td>{$row['requester_add2']}</td></tr>
          <tr><th>City</th><td>{$row['requester_city']}</td></tr>
          <tr><th>State</th><td>{$row['requester_state']}</td></tr>
          <tr><th>Zip</th><td>{$row['requester_zip']}</td></tr>
          <tr><th>Request Info</th><td>{$row['request_info']}</td></tr>
          <tr><th>Request Description</th><td>{$row['request_desc']}</td></tr>
          <tr><th>Request Date</th><td>{$row['request_date']}</td></tr>
          <tr>
            <td colspan='2' class='text-center'>
              <form class='d-print-none'>
                <input class='btn btn-danger' type='button' value='Print' onClick='window.print()'>
              </form>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    ";
} else {
    echo "<div class='alert alert-danger mt-5'>Unable to retrieve request details. Please try again later.</div>";
}

$stmt->close();
$conn->close();
include('includes/footer.php'); 
?>
