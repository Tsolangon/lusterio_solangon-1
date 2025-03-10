<?php
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");
include("../../dB/config.php");

// Fetch all products
$result = $conn->query("SELECT * FROM products ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Inventory</title>

    <!-- Bootstrap, DataTables, SweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body { background-color: #F6F0F0; font-family: 'Poppins', sans-serif; }
        .container { padding: 30px; }
        h2 { color: #735240; font-weight: bold; }
        .table-container { background: white; padding: 20px; border-radius: 12px; box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.1); }
        
        /* Styled Table */
        .table {
            width: 100%;
            border-radius: 12px;
            overflow: hidden;
        }

        .table thead th {
            background: #735240;
            color: white;
            text-align: center;
            padding: 15px;
            font-size: 14px;
            text-transform: uppercase;
        }

        .table tbody tr:nth-child(even) {
            background: #FAEBD7; /* Light beige for alternate rows */
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

        /* Inventory Search Bar (UNIQUE ID) */
        #inventorySearch {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
            margin-bottom: 15px;
        }

        /* Editable Stock Input */
        .stock-input {
            width: 60px;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 5px;
        }

        /* Update Button */
        .update-btn {
            background-color: #5A3D2B;
            color: white;
            border: none;
            padding: 5px 12px;
            font-size: 12px;
            border-radius: 5px;
            cursor: pointer;
        }

        .update-btn:hover {
            background: #4A2C1D;
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
    <h2 class="mb-4">Stock Inventory</h2>

    <!-- **Inventory Search Bar (with Unique ID)** -->
    <input type="text" id="inventorySearch" class="form-control" placeholder="Search for products...">

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Product Name</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Stock</th>
                    <th class="text-center">Size</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody id="productTableBody">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr id="row-<?= $row['id']; ?>">
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['product_name']; ?></td>
                        <td><?= $row['product_description']; ?></td>
                        <td>₱<?= number_format($row['price'], 2); ?></td>
                        <td>
                            <input type="number" class="stock-input" data-id="<?= $row['id']; ?>" value="<?= $row['stock_quantity']; ?>">
                        </td>
                        <td><?= $row['size']; ?></td>
                        <td>
                            <button class="update-btn" data-id="<?= $row['id']; ?>">Update</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {
    // **Fix: Use UNIQUE ID for inventory search**
    $("#inventorySearch").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#productTableBody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    // Handle stock update via AJAX
    $(".update-btn").click(function() {
        let productId = $(this).data("id");
        let newStock = $(this).closest("tr").find(".stock-input").val();

        $.ajax({
            url: "update_stock.php",
            type: "POST",
            data: { id: productId, stock_quantity: newStock },
            dataType: "json",
            success: function(response) {
                if (response.status === "success") {
                    Swal.fire({
                        title: "Updated!",
                        text: "Stock has been updated successfully.",
                        icon: "success",
                        timer: 1500,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire("Error!", response.message, "error");
                }
            },
            error: function(xhr, status, error) {
                Swal.fire("Error!", "AJAX request failed: " + error, "error");
            }
        });
    });
});
</script>


</script>
<?php include("./includes/footer.php"); ?>
</body>
</html>
