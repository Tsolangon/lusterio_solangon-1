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
    
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <style>
        body {
            background-color: #F6F0F0;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            max-width: 500px;
            width: 100%;
            margin: auto;
            padding: 30px 0;
            flex-grow: 1;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.1);
            background: white;
            padding: 30px;
        }

        h2 {
            text-align: center;
            color: #735240;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: bold;
            color: #5A3D2B;
        }

        .form-control, .form-select {
            border-radius: 8px;
            padding: 10px;
            border: 1px solid #D5C4B1;
            background: #FDF8F3;
        }

        .form-control:focus, .form-select:focus {
            border-color: #735240;
            box-shadow: 0 0 5px rgba(115, 82, 64, 0.5);
        }

        .btn-primary {
            background: #735240;
            border: none;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            transition: 0.3s;
            border-radius: 8px;
        }

        .btn-primary:hover {
            background: #5A3D2B;
        }

        a {
            text-decoration: none !important;
            color: inherit;
        }

        a:hover, a:focus {
            text-decoration: none !important;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2><a href="#">Register New User</a></h2>
        <div class="card">
            <form id="registerUserForm">
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control" placeholder="Enter first name" required>
                    </div>
                    <div class="col">
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
                        placeholder="Enter 11-digit phone number (09XXXXXXXXX)" required
                        title="Enter a valid 11-digit phone number starting with 09">
                    <div class="invalid-feedback">Please enter a valid 11-digit phone number</div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gender</label>
                    <select name="gender" class="form-select" required>
                        <option value="" disabled selected>Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Birthday</label>
                    <input type="date" name="birthday" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="" disabled selected>Select Role</option>
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100">Register</button>
            </form>
            <div id="userResponse" class="mt-3"></div>
        </div>
    </div>
</body>
</html>



<script>
  $(document).ready(function() {
    $("#registerUserForm").submit(function(event) {
      event.preventDefault(); // Prevent form submission

      $.ajax({
        url: "sidebar/add_user.php",
        type: "POST",
        data: $(this).serialize(), // Send form data
        success: function(response) {
          $("#userResponse").html(response); // Show success or error message
          $("#registerUserForm")[0].reset(); // Clear the form
        }
      });
    });
  });
</script>