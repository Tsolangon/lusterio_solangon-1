<?php
include("../dB/config.php");
session_start();

if (isset($_POST['registration'])) {
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['cpassword']);
    $phoneNumber = trim($_POST['phoneNumber']);
    $gender = trim($_POST['gender']);
    $birthday = $_POST['birthday'];
    $role = ""; // 👈 Set role to blank

    // Validate if confirm password and password match
    if ($password !== $confirmPassword) {
        $_SESSION['message'] = "Passwords do not match";
        $_SESSION['code'] = "error";
        header("location:../registration.php");
        exit();
    }

    // Validate if email already exists
    $query = "SELECT email FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['message'] = "Email already exists";
        $_SESSION['code'] = "error";
        header("location:../registration.php");
        exit();
    }

    // Get last user ID
    $result = $conn->query("SELECT MAX(userId) AS last_id FROM users");
    $row = $result->fetch_assoc();
    $nextUserId = $row['last_id'] ? $row['last_id'] + 1 : 1; // If no users exist, start from 1

    // Insert user data into the database
    $query = "INSERT INTO users (userId, firstName, lastName, email, password, phoneNumber, gender, birthday, role) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("issssssss", $nextUserId, $firstName, $lastName, $email, $password, $phoneNumber, $gender, $birthday, $role);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Registered Successfully";
        $_SESSION['code'] = "success";
        header("location:../login.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
