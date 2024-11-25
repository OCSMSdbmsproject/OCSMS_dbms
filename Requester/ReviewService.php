<?php
define('TITLE', 'Review Services');
define('PAGE', 'ReviewService');
include('includes/header.php');
include('../dbConnection.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['is_login'])) {
    echo "<script> location.href='RequesterLogin.php'; </script>";
    exit;
}

$rEmail = $_SESSION['rEmail'];

// Fetch user ID for the logged-in requester securely
$userSql = "SELECT r_login_id FROM requesterlogin_tb WHERE r_email = ?";
$stmt = $conn->prepare($userSql);
$stmt->bind_param("s", $rEmail);
$stmt->execute();
$userResult = $stmt->get_result();
if ($userResult->num_rows == 1) {
    $userRow = $userResult->fetch_assoc();
    $userId = $userRow['r_login_id'];
} else {
    echo "<div class='alert alert-danger'>User not found!</div>";
    include('includes/footer.php');
    exit;
}

// Fetch service requests for the user securely
$serviceSql = "SELECT * FROM assignwork_tb WHERE requester_email = ?";
$stmt = $conn->prepare($serviceSql);
$stmt->bind_param("s", $rEmail);
$stmt->execute();
$serviceResult = $stmt->get_result();
?>

<div class="container mt-5">
    <h3 class="text-center">Your Service Requests</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Request ID</th>
                <th>Service Info</th>
                <th>Technician</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($serviceResult->num_rows > 0) {
                while ($serviceRow = $serviceResult->fetch_assoc()) {
                    // Check if a review already exists for this service securely
                    $serviceId = $serviceRow['request_id'];
                    $reviewCheckSql = "SELECT review_id FROM reviews_tb WHERE service_id = ? AND user_id = ?";
                    $reviewStmt = $conn->prepare($reviewCheckSql);
                    $reviewStmt->bind_param("ii", $serviceId, $userId);
                    $reviewStmt->execute();
                    $reviewCheckResult = $reviewStmt->get_result();
                    $hasReview = $reviewCheckResult->num_rows > 0;

                    // Display service request data in the table
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($serviceRow['request_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($serviceRow['request_desc']) . "</td>";
                    echo "<td>" . htmlspecialchars($serviceRow['assign_tech']) . "</td>";
                    // echo "<td>" . htmlspecialchars($serviceRow['rno']) . "</td>";
                    echo "<td>";
                    if ($hasReview) {
                        echo "<button class='btn btn-secondary btn-sm' disabled>Review Submitted</button>";
                    } else {
                        echo "<a href='SubmitReview.php?service_id=" . urlencode($serviceId) . "' class='btn btn-success btn-sm'>Leave Review</a>";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='text-center'>No Service Requests Found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include('includes/footer.php'); ?>
