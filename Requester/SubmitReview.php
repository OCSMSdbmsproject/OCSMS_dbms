<?php
include('../dbConnection.php');
session_start();

if (!isset($_SESSION['is_login'])) {
    echo "<script> location.href='RequesterLogin.php'; </script>";
}

$rEmail = $_SESSION['rEmail'];
$serviceId = $_GET['service_id'] ?? null;

$userSql = "SELECT r_login_id FROM requesterlogin_tb WHERE r_email='$rEmail'";
$userResult = $conn->query($userSql);
if ($userResult->num_rows == 1) {
    $userRow = $userResult->fetch_assoc();
    $userId = $userRow['r_login_id'];
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    $photo = "";

    // Handle Photo Upload
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "../uploads/";
        $photoName = basename($_FILES['photo']['name']);
        $targetFilePath = $targetDir . $photoName;

        // Validate file type
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array(strtolower($fileType), $allowedTypes)) {
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFilePath)) {
                $photo = $photoName;
            } else {
                $message = '<div class="alert alert-danger mt-3" role="alert">Error uploading photo.</div>';
            }
        } else {
            $message = '<div class="alert alert-danger mt-3" role="alert">Invalid photo format.</div>';
        }
    }

    $reviewSql = "INSERT INTO reviews_tb (service_id, user_id, rating, comment, photo) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($reviewSql);
    $stmt->bind_param('iiiss', $serviceId, $userId, $rating, $comment, $photo);

    if ($stmt->execute()) {
        $message = '<div class="alert alert-success mt-3" role="alert">Review submitted successfully!</div>';
    } else {
        $message = '<div class="alert alert-danger mt-3" role="alert">Error submitting review. Please try again.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Review</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Font Awesome CDN for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"> <!-- Correct CDN link for Font Awesome -->
    <style>
        .star-rating {
            display: inline-flex;
            direction: rtl; /* Make the stars clickable from right to left */
            font-size: 2em;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            color: #ddd;
            cursor: pointer;
        }

        .star-rating input:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: #f39c12; /* Gold color for selected stars */
        }

        .star-rating label:active {
            color: #e67e22; /* Slightly darker gold for active state */
        }

        .star-rating input:checked + label {
            color: #f39c12;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Submit Your Review</h2>

        <!-- Display success or error message -->
        <?php if (!empty($message)) echo $message; ?>

        <!-- Review submission form -->
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="rating">Rating</label>
                <div class="star-rating">
                    <!-- Star rating input fields -->
                    <input type="radio" id="star5" name="rating" value="5" required><label for="star5"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star4" name="rating" value="4"><label for="star4"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star3" name="rating" value="3"><label for="star3"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star2" name="rating" value="2"><label for="star2"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star1" name="rating" value="1"><label for="star1"><i class="fas fa-star"></i></label>
                </div>
            </div>
            <div class="form-group">
                <label for="comment">Comment</label>
                <textarea name="comment" class="form-control" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="photo">Upload Photo</label>
                <input type="file" name="photo" class="form-control" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Submit Review</button>
        </form>
    </div>

    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
