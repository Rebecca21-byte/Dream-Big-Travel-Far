<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn = new mysqli('localhost', 'root', '', 'traveling'); // Update the database name
    if ($conn->connect_error) {
        die('Connection has Failed : ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("SELECT password FROM signup WHERE email = ?");
        if (!$stmt) {
            die("Error: " . $conn->error);
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($hashedPassword);

        // ... (previous code)

if ($stmt->fetch()) {
    // Compare the provided password with the one stored in the database (without hashing)
    if ($password === $hashedPassword) {
        // Password is correct
        session_start();
        $_SESSION['email'] = $email; // Store username in the session
        header('Location: index.html'); // Redirect to the dashboard page
        exit; // Make sure to exit after redirecting
    } else {
        // Password is incorrect
        echo "Incorrect password";
    }
} else {
    // User not found
    echo "User not found";
}
        $stmt->close();
        $conn->close();
    }
}
?>
