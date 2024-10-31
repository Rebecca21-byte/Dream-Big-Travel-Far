<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

  $conn = new mysqli('localhost', 'root', '', 'testing');

    if ($conn->connect_error) {
        die('Connection has Failed: ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO user (name, email, subject, message) VALUES (?, ?, ?, ?)");

        if (!$stmt) {
            die("Error: " . $conn->error);
        }

        $stmt->bind_param("ssss", $name, $email, $subject, $message);

        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            // Log the error for further investigation
            error_log("Error: " . $stmt->error);
            echo "Oops! Something went wrong. Please try again later.";
        }

        $stmt->close();
        $conn->close();
    }
}
?>
