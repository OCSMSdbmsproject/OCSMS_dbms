<?php
session_start();

// Include database connection
include('dbConnection.php');

// Initialize variables for feedback message
$message = '';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $messageContent = mysqli_real_escape_string($conn, $_POST['message']);

    // Validate the input fields
    if (empty($name) || empty($email) || empty($messageContent)) {
        $message = 'All fields are required!';
    } else {
        // Insert into the database (contact_us_tb)
        $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $messageContent);

        if ($stmt->execute()) {
            $message = 'Thank you for contacting us! We will get back to you shortly.';
        } else {
            $message = 'Failed to send your message. Please try again later.';
        }

        // Close the prepared statement
        $stmt->close();
    }

    // Store the message in session to be used in the modal
    $_SESSION['message'] = $message;
    // Redirect back to the page with the session message
    header('Location: index.php');
    exit;
}
?>
