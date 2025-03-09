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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* General Body Styling */
        body {
            background-color: #F6F0F0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
        }
        .container-fluid {
            padding: 30px;
            flex-grow: 1;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.1);
            background: white;
            padding: 30px;
            width: 100%;
        }

        h2 {
            text-align: left;
            color: #735240;
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* Styling Table */
        .table {
            width: 100%;
            border-radius: 12px;
            overflow: hidden;
        }

        .table th {
            background: #735240;
            color: white;
            text-align: center;
            padding: 15px;
            font-size: 14px;
            text-transform: uppercase;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        .table td {
            color: #5A3D2B;
            text-align: center;
            vertical-align: middle;
            padding: 15px;
            font-size: 14px;
        }

        .table tbody tr:hover {
            background: #FDF8F3;
        }

        /* Delete Button */
        .btn-danger {
            background: #D9534F;
            border: none;
            padding: 6px 12px;
            font-size: 14px;
            border-radius: 6px;
            transition: 0.3s;
        }

        .btn-danger:hover {
            background: #C9302C;
        }

        /* DataTables Styling */
        .dataTables_wrapper {
            padding: 20px;
        }

        .dataTables_length, .dataTables_filter {
            margin-bottom: 15px;
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

<div class="container-fluid">
    <h2>User List</h2>

    <div class="card">
        <table id="userTable" class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Contact</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Join Date</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr id="row_<?php echo $row["userId"]; ?>">
                            <td class="text-center"><?php echo $row["userId"]; ?></td>
                            <td class="text-center"><?php echo $row["fullName"]; ?></td>
                            <td class="text-center"><?php echo $row["phoneNumber"]; ?></td>
                            <td class="text-center"><?php echo $row["email"]; ?></td>
                            <td class="text-center"><?php echo date("Y/m/d", strtotime($row["createdAt"])); ?></td>
                            <td class="text-center">
                                <button class="btn btn-danger btn-sm delete-btn" data-id="<?php echo $row['userId']; ?>">
                                    Delete
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
    $("#userTable").DataTable({
        "paging": true,  
        "searching": true,  
        "ordering": false, // Disable sorting globally
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    });

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
