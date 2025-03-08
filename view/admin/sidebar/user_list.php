<?php
include("../../../dB/config.php"); // Database connection

$query = "SELECT userId, CONCAT(firstName, ' ', lastName) AS fullName, phoneNumber, email, createdAt FROM users ORDER BY createdAt DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Import jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert -->
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center text-primary">User List</h2>

    <div class="card shadow p-4">
        <table class="table table-striped">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Join Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="userTable">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr id="row_<?php echo $row["userId"]; ?>">
                            <td><?php echo $row["userId"]; ?></td>
                            <td><?php echo $row["fullName"]; ?></td>
                            <td><?php echo $row["phoneNumber"]; ?></td>
                            <td><?php echo $row["email"]; ?></td>
                            <td><?php echo date("Y/m/d", strtotime($row["createdAt"])); ?></td>
                            <td>
                                <button class="btn btn-danger btn-sm delete-btn" data-id="<?php echo $row['userId']; ?>">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>No users found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {
    $(".delete-btn").click(function() {
        var userId = $(this).data("id");
        var row = $("#row_" + userId);

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "sidebar/delete_user.php",
                    type: "POST",
                    data: { id: userId },
                    success: function(response) {
                        if (response == "success") {
                            Swal.fire({
                                title: "Deleted!",
                                text: "User has been deleted.",
                                icon: "success",
                                timer: 1500,
                                showConfirmButton: false
                            });
                            row.fadeOut(500, function() { $(this).remove(); });
                        } else {
                            Swal.fire("Error!", "User could not be deleted.", "error");
                        }
                    }
                });
            }
        });
    });
});
</script>

</body>
</html>
