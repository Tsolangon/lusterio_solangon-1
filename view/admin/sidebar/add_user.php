<?php
include("../../../dB/config.php"); // Ensure this is the correct database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = trim($_POST["first_name"]);
    $lastName = trim($_POST["last_name"]);
    $email = trim($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT); // Encrypt password
    $phoneNumber = trim($_POST["phone"]);
    $gender = $_POST["gender"];
    $birthday = $_POST["birthday"];
    $role = $_POST["role"];
    $verification = 0; // Default value for new users

    // Insert into users table
    $sql = "INSERT INTO users (firstName, lastName, email, password, phoneNumber, gender, birthday, role, verification, createdAt) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssi", $firstName, $lastName, $email, $password, $phoneNumber, $gender, $birthday, $role, $verification);

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

<div class="container mt-5">
    <h2 class="text-center text-primary">Register User</h2>
    <div class="card shadow p-4">
        <form id="registerUserForm">
            <div class="mb-3">
                <label class="form-label">First Name</label>
                <input type="text" name="first_name" class="form-control" placeholder="Enter first name" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Last Name</label>
                <input type="text" name="last_name" class="form-control" placeholder="Enter last name" required>
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
                <input type="text" name="phone" class="form-control" placeholder="Enter phone number" required>
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
        <div id="userResponse"></div> <!-- Display success or error message -->
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
          $("#userResponse").html(response); // Show success or error message
          $("#registerUserForm")[0].reset(); // Clear the form
        }
      });
    });
  });
</script>
