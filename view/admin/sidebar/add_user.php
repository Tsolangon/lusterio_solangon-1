<?php
include("../../../dB/config.php"); // Ensure this is the correct database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = trim($_POST["first_name"]);
    $lastName = trim($_POST["last_name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]); // Storing password as plaintext (Not recommended)
    $phoneNumber = trim($_POST["phoneNumber"]);
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
    <label for="yourPhoneNumber" class="form-label">Phone Number</label>
    <div class="input-group has-validation">
        <input type="tel" name="phoneNumber" class="form-control" id="yourPhoneNumber"
            pattern="09[0-9]{9}" minlength="11" maxlength="11"
            placeholder="Enter 11-digit phone number (09XXXXXXXXX)" required
            title="Enter a valid 11-digit phone number starting with 09">
        <div class="invalid-feedback">Please enter a valid 11-digit phone number</div>
    </div>
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