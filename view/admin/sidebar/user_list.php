<?php
include("../../../dB/config.php"); // Database connection

$query = "SELECT userId, CONCAT(firstName, ' ', lastName) AS fullName, phoneNumber, email, createdAt FROM users ORDER BY createdAt DESC";
$result = $conn->query($query);
?>

<div class="container mt-5">
    <h2 class="text-center text-primary">User List</h2>
    <div class="card shadow p-4">
        <table class="table table-striped">
            <thead class="table-light">
                <tr>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Join Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $row["fullName"]; ?></td>
                            <td><?php echo $row["phoneNumber"]; ?></td>
                            <td><?php echo $row["email"]; ?></td>
                            <td><?php echo date("Y/m/d", strtotime($row["createdAt"])); ?></td>
                            <td>
                                <a href="delete_user.php?id=<?php echo $row['userId']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>No users found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php $conn->close(); ?>
