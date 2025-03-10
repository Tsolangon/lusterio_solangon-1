<?php
session_start();
include("../dB/config.php");

if(isset($_POST["login"])) {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Query to check if user exists
    $query = "SELECT userId, firstName, lastName, email, password, phoneNumber, gender, birthday, verification, role 
              FROM users WHERE email = ? AND password = ? LIMIT 1";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $data = $result->fetch_assoc();

        $userID = $data["userId"];
        $fullname = $data["firstName"]." ".$data["lastName"];
        $emailAddress = $data["email"];
        $userRole = strtolower($data["role"]); // Convert role to lowercase for consistency

        $_SESSION["auth"] = true;
        $_SESSION["role"] = $userRole;
        $_SESSION["authUser"] = [
            'userId' => $userID, // ✅ Corrected variable name
            'fullName' => $fullname,
            'emailAddress' => $emailAddress,
        ];

        // Redirect based on role
        if($userRole == 'admin'){
            header("Location: ../view/admin/index.php");
        } else if ($userRole == "user"){ 
            header("Location: ../view/users/dashboard.php");
        } else {
            $_SESSION['message'] = "Invalid Credentials";
            $_SESSION["code"] = "error";
            header("Location: ../login.php");
        }
        exit();
    } else {
        $_SESSION['status'] = "Invalid email or password";
        $_SESSION["code"] = "error";
        header("Location: ../login.php");
        exit();
    }
}
?>
