<?php
include('../dbConnection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $technician_id = $_POST['technician_id'] ?? null;
  $message = $_POST['message'] ?? null;

  if (!$technician_id || !$message) {
    echo "Technician ID or message is missing.";
    exit;
  }

  $sql = "INSERT INTO technician_messages (technician_id, message) VALUES (?, ?)";
  $stmt = $conn->prepare($sql);

  if ($stmt) {
    $stmt->bind_param('is', $technician_id, $message);

    if ($stmt->execute()) {
      echo "Message sent successfully!";
    } else {
      echo "Database error: " . $stmt->error;
    }

    $stmt->close();
  } else {
    echo "SQL error: " . $conn->error;
  }

  $conn->close();
} else {
  echo "Invalid request method.";
}
