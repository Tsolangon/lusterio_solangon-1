<?php
$servername = "localhost";
$username = "root"; // Change if using a different user
$password = ""; // Add password if set
$dbname = "lusterio_solangon"; // Change to your DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
