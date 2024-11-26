<?php
define('TITLE', 'Request Success');
define('PAGE', 'SubmitRequest');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();

// Ensure that the session variable 'myid' exists
if (isset($_SESSION['myid'])) {
    $genid = $_SESSION['myid'];

    // Fetch the request details from the database
    $sql = "SELECT * FROM submitrequest_tb WHERE request_id = '$genid'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
        <div class="col-sm-9 col-md-10 mt-5">
            <h3 class="text-center text-success">Request Submitted Successfully</h3>
            <p><strong>Request ID: </strong><?php echo $row['request_id']; ?></p>
            <p><strong>Request Info: </strong><?php echo $row['request_info']; ?></p>
            <p><strong>Description: </strong><?php echo $row['request_desc']; ?></p>
            <p><strong>Name: </strong><?php echo $row['requester_name']; ?></p>
            <p><strong>Address Line 1: </strong><?php echo $row['requester_add1']; ?></p>
            <p><strong>Address Line 2: </strong><?php echo $row['requester_add2']; ?></p>
            <p><strong>City: </strong><?php echo $row['requester_city']; ?></p>
            <p><strong>State: </strong><?php echo $row['requester_state']; ?></p>
            <p><strong>Zip: </strong><?php echo $row['requester_zip']; ?></p>
            <p><strong>Email: </strong><?php echo $row['requester_email']; ?></p>
            <p><strong>Mobile: </strong><?php echo $row['requester_mobile']; ?></p>
            <p><strong>Date: </strong><?php echo $row['request_date']; ?></p>

            <!-- Print button -->
            <form class="d-print-none">
                <input class="btn btn-danger" type="submit" value="Print" onClick="window.print()">
            </form>
        </div>
        <?php
    } else {
        echo "<div class='alert alert-warning col-sm-6 ml-5 mt-2' role='alert'>No Request Found!</div>";
    }
} else {
    echo "<div class='alert alert-danger col-sm-6 ml-5 mt-2' role='alert'>No Request ID found in session!</div>";
}
?>
<?php include('includes/footer.php'); ?>
