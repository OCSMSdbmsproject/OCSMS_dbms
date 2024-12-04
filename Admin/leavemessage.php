<?php
include('../dbConnection.php');
session_start();

if(isset($_SESSION['is_adminlogin'])) {
    $aEmail = $_SESSION['aEmail'];
} else {
    echo "<script> location.href='login.php'; </script>";
}

if(isset($_GET['empid'])) {
    $empid = $_GET['empid']; // Retrieve the empid of the technician
}

if(isset($_POST['submit'])) {
    $message = $_POST['message'];
    $request_id = $_POST['request_id']; // Retrieve the request_id from the form

    // Fetch the request details (if needed) to construct a more detailed message
    $sql_request = "SELECT * FROM request_tb WHERE request_id = ?";
    $stmt_request = $conn->prepare($sql_request);
    $stmt_request->bind_param("i", $request_id);
    $stmt_request->execute();
    $result_request = $stmt_request->get_result();
    
    if($result_request->num_rows > 0) {
        $request_details = $result_request->fetch_assoc();
        $requester_name = $request_details['requester_name'];
        $requester_message = $request_details['message']; // Get the request message if needed
    } else {
        $requester_name = 'Unknown';
        $requester_message = 'No message available';
    }

    // Construct a detailed message for the technician
    $detailed_message = "New Request (ID: $request_id) from $requester_name: \n\n$requester_message\n\nAdmin: $message";

    // Update the technician's record with the assigned message
    $sql = "UPDATE technician_tb SET assigned_customer_message = ? WHERE empid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $detailed_message, $empid);

    if($stmt->execute()) {
        // Redirect to the same page with a success parameter
        header("Location: leave_message.php?empid=$empid&success=1");
        exit();
    } else {
        echo "<script>alert('Error sending message!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Message</title>

    <!-- Link to Google Fonts for modern typography -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- Link to Bootstrap for styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS for modern effects -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin-top: 50px;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-weight: 600;
            text-align: center;
            margin-bottom: 20px;
            color: #343a40;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ced4da;
            padding: 15px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #28a745;
            box-shadow: 0 0 5px rgba(40, 167, 69, 0.5);
        }

        button[type="submit"] {
            background-color: #28a745;
            color: white;
            font-size: 16px;
            font-weight: 500;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #218838;
            transform: scale(1.05);
        }

        .btn-back {
            background-color: #007bff;
            color: white;
            margin-top: 20px;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
        }

        .btn-back:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .alert {
            margin-top: 30px;
            font-size: 16px;
            font-weight: 500;
        }

        /* Mobile responsiveness */
        @media (max-width: 767px) {
            .container {
                padding: 20px;
            }

            h2 {
                font-size: 20px;
            }

            button[type="submit"] {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Leave Message for Technician</h2>

        <?php if(isset($_GET['success']) && $_GET['success'] == 1): ?>
            <div class="alert alert-success">
                Message sent successfully!
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <input type="hidden" name="empid" value="<?php echo $empid; ?>">
            <div class="form-group">
                <label for="request_id">Request ID:</label>
                <input type="text" class="form-control" name="request_id" id="request_id" required>
            </div>

            <div class="form-group">
                <label for="message">Message:</label>
                <textarea class="form-control" name="message" id="message" rows="4" required></textarea>
            </div>

            <button type="submit" name="submit" class="btn btn-success">Send Message</button>
        </form>

        <a href="technician.php" class="btn btn-back mt-4">Back to Technician List</a>
    </div>

    <!-- Link to Bootstrap JS and Popper.js for Bootstrap functionality -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
