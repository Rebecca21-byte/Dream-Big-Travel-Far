<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $username = $_POST['username'];
   $email = $_POST['email'];
   $password = $_POST['password']; // Plain text password

   $conn = new mysqli('localhost', 'root', '', 'traveling');
   if ($conn->connect_error) {
       die('Connection has Failed : ' . $conn->connect_error);
   } else {
       $stmt = $conn->prepare("INSERT INTO signup (username, email, password) VALUES (?, ?, ?)");
       if (!$stmt) {
           die("Error: " . $conn->error);
       }

       $stmt->bind_param("sss", $username, $email, $password);

       if ($stmt->execute()) {
     // Redirect to index.html on successful login
     header('Location: index.html');
     // Add JavaScript alert
     echo '<script type="text/javascript">alert("Successfully logged in");</script>';
 } else {
     // Display error message if execution fails
     echo "Error: " . $stmt->error;
 }

       $stmt->close();
       $conn->close();
   }
}
?>
