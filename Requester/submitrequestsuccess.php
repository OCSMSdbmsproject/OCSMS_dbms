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
        <div class="container mt-5">
            <div class="row justify-content-center">
                <!-- Heading outside the box -->
                <h3 class="text-center mb-4 text-dark">Request Submitted Successfully</h3>

                <!-- Content Box -->
                <div class="col-md-10 col-lg-8">
                    <div class="card shadow-lg rounded-lg border-0">
                        <div class="card-body p-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Request ID: </strong><?php echo $row['request_id']; ?></p>
                                    <p><strong>Request Info: </strong><?php echo $row['request_info']; ?></p>
                                    <p><strong>Description: </strong><?php echo $row['request_desc']; ?></p>
                                    <p><strong>Name: </strong><?php echo $row['requester_name']; ?></p>
                                    <p><strong>Address Line 1: </strong><?php echo $row['requester_add1']; ?></p>
                                    <p><strong>Address Line 2: </strong><?php echo $row['requester_add2']; ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>City: </strong><?php echo $row['requester_city']; ?></p>
                                    <p><strong>State: </strong><?php echo $row['requester_state']; ?></p>
                                    <p><strong>Zip: </strong><?php echo $row['requester_zip']; ?></p>
                                    <p><strong>Email: </strong><?php echo $row['requester_email']; ?></p>
                                    <p><strong>Mobile: </strong><?php echo $row['requester_mobile']; ?></p>
                                    <p><strong>Date: </strong><?php echo $row['request_date']; ?></p>
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <!-- Print button -->
                                <form class="d-print-none">
                                    <button class="btn btn-danger btn-lg rounded-pill" type="submit" onClick="window.print()">
                                        <i class="fas fa-print"></i> Print
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

<style>
    /* Apply Background Color to Body */
    body {
        background-color: #f1f8ff;  /* Light blue background */
        font-family: 'Arial', sans-serif;
    }

    /* General Styling for the Box and Card */
    .card {
        border: none;
        background-color: #ffffff;
        border-radius: 20px;
        box-shadow: 0px 15px 30px rgba(0, 0, 0, 0.1);
    }

    .card-body {
        padding: 40px;
    }

    /* Heading Styling */
    h3 {
        font-size: 30px;  /* Larger font size */
        font-weight: 700;
        color: #333;  /* Dark text for the heading */
        letter-spacing: 0.5px;
        margin-bottom: 20px;
    }

    /* Text Styling */
    .row p {
        font-size: 16px;
        line-height: 1.8;
        margin-bottom: 15px;
    }

    .row p strong {
        color: #555;
        font-weight: bold;
    }

    /* Button Styling */
    .btn-danger {
        background-color: #DC3545; /* Red color for the print button */
        color: white;
        font-size: 18px;
        font-weight: 600;
        padding: 12px 30px;
        border-radius: 50px;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-danger:hover {
        background-color: #c82333; /* Darker red on hover */
        transform: scale(1.05);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    /* Button Icon Styling */
    .btn-danger i {
        margin-right: 10px;
    }

    /* Alert Styling */
    .alert {
        font-size: 16px;
        font-weight: 500;
    }

    /* Responsiveness */
    @media (max-width: 768px) {
        .card-body {
            padding: 30px;
        }
        .row p {
            font-size: 14px;
        }
        .btn-danger {
            font-size: 16px;
            padding: 10px 20px;
        }
    }
</style>
