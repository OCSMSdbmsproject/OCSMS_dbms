<?php
// Include necessary files and start the session
include('../dbConnection.php');
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['is_login'])) {
    echo "<script> location.href='RequesterLogin.php'; </script>";
}

$rEmail = $_SESSION['rEmail'];  // Get the logged-in user's email
$serviceId = $_GET['service_id'] ?? null;  // Get service ID from the URL (assuming it's passed as a query parameter)

// Fetch the logged-in user's ID from the database
$userSql = "SELECT r_login_id FROM requesterlogin_tb WHERE r_email='$rEmail'";
$userResult = $conn->query($userSql);
if ($userResult->num_rows == 1) {
    $userRow = $userResult->fetch_assoc();
    $userId = $userRow['r_login_id'];
}

// Initialize a message variable
$message = "";

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rating = $_POST['rating'];  // Get the rating (1-5)
    $comment = $_POST['comment'];  // Get the comment

    // Insert the review into the database (created_at is automatically handled by MySQL)
    $reviewSql = "INSERT INTO reviews_tb (service_id, user_id, rating, comment) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($reviewSql);
    $stmt->bind_param('iiis', $serviceId, $userId, $rating, $comment);

    // Check if the insertion was successful
    if ($stmt->execute()) {
        $message = '<div class="alert alert-success mt-3 review-message" role="alert">Review submitted successfully!</div>';
    } else {
        $message = '<div class="alert alert-danger mt-3 review-message" role="alert">Error submitting review. Please try again.</div>';
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
    <style>
        /* Custom styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        h2 {
            font-size: 1.75rem;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #ced4da;
            padding: 10px;
            font-size: 1rem;
        }

        .form-control:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 5px rgba(72, 209, 204, 0.7);
        }

        .btn-primary {
            background-color: #4CAF50;
            border-color: #4CAF50;
            font-size: 1.2rem;
            padding: 10px 15px;
        }

        .btn-primary:hover {
            background-color: #45a049;
            border-color: #45a049;
        }

        .alert {
            font-size: 1.1rem;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            margin-top: 20px;
        }

        .alert-success {
            background-color: #28a745;
            color: #fff;
        }

        .alert-danger {
            background-color: #dc3545;
            color: #fff;
        }

        /* Custom styling for review messages */
        .review-message {
            display: inline-block;
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
        }

        /* Star Rating Styles */
        .star-rating {
            display: inline-block;
            font-size: 0;
            direction: rtl; /* Right to left */
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            font-size: 30px;
            color: #ddd;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        /* Highlight stars based on the rating selected */
        .star-rating input:checked ~ label {
            color: #ffcc00;
        }

        .star-rating input:checked + label {
            color: #ffcc00;
        }

        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: #ffcc00;
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            h2 {
                font-size: 1.5rem;
            }

            .form-control {
                font-size: 0.95rem;
            }

            .btn-primary {
                font-size: 1.1rem;
                padding: 8px 12px;
            }
        }

        @media (max-width: 576px) {
            h2 {
                font-size: 1.25rem;
            }

            .form-control {
                font-size: 0.9rem;
            }

            .btn-primary {
                font-size: 1rem;
                padding: 7px 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Submit Your Review</h2>
        <form method="POST">
            <div class="form-group">
                <label for="rating">Rating</label>
                <div class="star-rating">
                    <input type="radio" id="star5" name="rating" value="5" required><label for="star5">★</label>
                    <input type="radio" id="star4" name="rating" value="4"><label for="star4">★</label>
                    <input type="radio" id="star3" name="rating" value="3"><label for="star3">★</label>
                    <input type="radio" id="star2" name="rating" value="2"><label for="star2">★</label>
                    <input type="radio" id="star1" name="rating" value="1"><label for="star1">★</label>
                </div>
            </div>
            <div class="form-group">
                <label for="comment">Comment</label>
                <textarea name="comment" class="form-control" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Review</button>
        </form>

        <!-- Display success or error message -->
        <?php 
        if (!empty($message)) {
            echo $message;
        }
        ?>
    </div>

    <script>
        // Add JavaScript to handle star rating interactions if needed
    </script>
</body>
</html>
