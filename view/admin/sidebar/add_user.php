<?php
include("../../../dB/config.php"); // Ensure this is the correct database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = trim($_POST["first_name"]);
    $lastName = trim($_POST["last_name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]); // Storing password as plaintext (Not recommended)
    $phoneNumber = trim($_POST["phone"]);
    $gender = $_POST["gender"];
    $birthday = $_POST["birthday"];
    $role = strtolower(trim($_POST["role"]));
    $verification = 0; // Default value for new users

    // Get the last user ID from the database
    $result = $conn->query("SELECT MAX(userId) as last_id FROM users");
    $row = $result->fetch_assoc();
    $nextUserId = $row['last_id'] ? $row['last_id'] + 1 : 1; // If no users exist, start from 1

    // Insert into users table with a manually assigned ID
    $sql = "INSERT INTO users (userId, firstName, lastName, email, password, phoneNumber, gender, birthday, role, verification, createdAt) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssssssi", $nextUserId, $firstName, $lastName, $email, $password, $phoneNumber, $gender, $birthday, $role, $verification);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>User registered successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
    }

    $stmt->close();
    $conn->close();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <style>
        /* Ensure the page takes the full height */
        html, body {
            height: 100%;
            display: flex;
            flex-direction: column;
            background-color: #F6F0F0;
            font-family: 'Poppins', sans-serif;
        }

        /* Pushes the content up so the footer stays at the bottom */
        .container {
            flex: 1;
            max-width: 800px;
            width: 100%;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* Card Styling */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.15);
            background: white;
            padding: 40px;
        }

        h2 {
            text-align: center;
            color: #735240;
            font-weight: bold;
            margin-bottom: 30px;
            font-size: 28px;
        }

        /* Form Styles */
        .form-label {
            font-weight: bold;
            color: #5A3D2B;
            font-size: 16px;
        }

        .form-control, .form-select {
            border-radius: 10px;
            padding: 12px;
            border: 1px solid #D5C4B1;
            background: #FDF8F3;
            font-size: 16px;
        }

        .form-control:focus, .form-select:focus {
            border-color: #735240;
            box-shadow: 0 0 8px rgba(115, 82, 64, 0.5);
        }

        /* Button Styling */
        .btn-primary {
            background: #735240;
            border: none;
            padding: 14px;
            font-size: 18px;
            font-weight: bold;
            transition: all 0.3s ease;
            border-radius: 10px;
            width: 100%;
        }

        .btn-primary:hover {
            background: #5A3D2B;
            transform: scale(1.02);
        }
        a {
            text-decoration: none !important;
            color: inherit;
        }

        a:hover, a:focus {
            text-decoration: none !important;
        }



        /* Responsive */
        @media (max-width: 768px) {
            .container {
                max-width: 90%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Register New User</h2>
        <div class="card">
            <form id="registerUserForm">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control" placeholder="Enter first name" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-control" placeholder="Enter last name" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter password" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone Number</label>
                    <input type="tel" name="phone" class="form-control" pattern="09[0-9]{9}" minlength="11" maxlength="11"
                        placeholder="09XXXXXXXXX" required>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-select" required>
                            <option value="" disabled selected>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Birthday</label>
                        <input type="date" name="birthday" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="" disabled selected>Select Role</option>
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Register</button>
            </form>
            <div id="userResponse" class="mt-3"></div>
        </div>
    </div>


<script>
$(document).ready(function() {
    $("#registerUserForm").submit(function(event) {
        event.preventDefault(); // Prevent form submission

        $.ajax({
            url: "sidebar/add_user.php",
            type: "POST",
            data: $(this).serialize(), // Send form data
            success: function(response) {
                $("#userResponse").html(response).fadeIn(); // Show success message

                // Ensure the message is visible, then fade out after 5 seconds
                setTimeout(function() {
                    $("#userResponse").fadeOut("slow", function() {
                        $(this).html(""); // Clear the message after fading out
                    });
                }, 5000);

                $("#registerUserForm")[0].reset(); // Clear the form
            }
        });
    });
});
</script>