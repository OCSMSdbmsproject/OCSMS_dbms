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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        /* Page Styling */
        body {
            background-color: #e6f4ff; /* Light blue background for outer area */
            font-family: 'Arial', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #ffffff; /* White background for the inner box */
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #2575fc;
            font-size: 2.5rem;
            margin-bottom: 20px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .star-rating {
            display: inline-flex;
            direction: rtl;
            font-size: 2.5rem;
            color: #ddd;
            cursor: pointer;
            margin-bottom: 10px;
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
            color: #ffb400; /* Gold color for stars */
        }

        .star-rating label:active {
            color: #e67e22;
        }

        textarea.form-control {
            resize: none;
            border-radius: 8px;
            padding: 15px;
            font-size: 1rem;
            border: 1px solid #ddd;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #ffffff; /* Light white background for textarea */
        }

        input[type="file"] {
            border: none;
            background-color: #ffffff; /* Light background for file input */
            padding: 10px;
            font-size: 1rem;
            color: #444;
            border-radius: 5px;
        }

        input[type="file"]:focus,
        textarea.form-control:focus {
            box-shadow: 0 0 10px rgba(39, 117, 252, 0.6);
            outline: none;
        }

        button.btn-primary {
            background-color: #2575fc;
            border: none;
            padding: 12px 20px;
            font-size: 1.2rem;
            border-radius: 5px;
            color: #fff;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        button.btn-primary:hover {
            background-color: #1f61db;
            transform: translateY(-3px);
        }

        .alert {
            border-radius: 8px;
            text-align: center;
            padding: 10px;
        }

        /* Styling for inputs and textareas to make them pop */
        .form-control {
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #2575fc;
            box-shadow: 0 0 8px rgba(39, 117, 252, 0.5);
        }

        /* Additional hover effects for the form inputs */
        .form-control:hover {
            border-color: #1f61db;
        }

        /* Styling the file input box */
        input[type="file"] {
            background-color: #f0f4f8;
            border-radius: 5px;
            padding: 8px;
        }

        /* Additional hover effects for the file input */
        input[type="file"]:hover {
            background-color: #dfe4f1;
        }
    </style>
</head>
<body>

    <div class="container">
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
