<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "game";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} 

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from the form
    $email = mysqli_real_escape_string($conn, $_POST["Email"]);
    $password = mysqli_real_escape_string($conn, $_POST["Password"]);

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO login (Email, Password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $password);

    // Execute the query
    if ($stmt->execute()) {
        echo "Record inserted successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();

?>
