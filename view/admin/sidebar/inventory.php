<?php
include("../../../dB/config.php");

// Fetch all products
$result = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Inventory</title>

    <!-- Bootstrap & DataTables -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <style>
        body { background-color: #F6F0F0; font-family: 'Poppins', sans-serif; }
        .container { padding: 30px; }
        h2 { color: #735240; font-weight: bold; }
        .table-container { background: white; padding: 20px; border-radius: 12px; box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.1); }
        .table thead th { background: #735240; color: white; text-align: center; font-size: 14px; border: none; }
        .table td { text-align: center; vertical-align: middle; padding: 15px; font-size: 14px; }
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
    <h2>Stock Inventory</h2>
    <button class="btn btn-success my-3" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</button>

    <div class="table-container">
        <table id="inventoryTable" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Size</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="productTableBody">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr id="row-<?= $row['id']; ?>">
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['product_name']; ?></td>
                        <td><?= $row['product_description']; ?></td>
                        <td>₱<?= number_format($row['price'], 2); ?></td>
                        <td><?= $row['stock_quantity']; ?></td>
                        <td><?= $row['size']; ?></td>
                        <td>
                            <button class="btn btn-danger delete-btn" data-id="<?= $row['id']; ?>">Delete</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addProductForm">
                    <div class="mb-3"><label>Product Name</label><input type="text" name="product_name" class="form-control" required></div>
                    <div class="mb-3"><label>Description</label><textarea name="product_description" class="form-control" required></textarea></div>
                    <div class="mb-3"><label>Price</label><input type="number" name="price" class="form-control" step="0.01" required></div>
                    <div class="mb-3"><label>Stock</label><input type="number" name="stock_quantity" class="form-control" required></div>
                    <div class="mb-3">
                        <label>Size</label>
                        <select name="size" class="form-select" required>
                            <option value="Adjustable">Adjustable</option>
                            <option value="Small">Small</option>
                            <option value="Medium">Medium</option>
                            <option value="Large">Large</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Add Product</button>
                </form>

                <!-- Success message -->
                <div id="successMessage" class="alert alert-success mt-3" style="display: none;">
                    Product successfully added!
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $("#inventoryTable").DataTable();

    // Handle product addition via AJAX
    $("#addProductForm").submit(function(event) {
        event.preventDefault();

        $.ajax({
            url: "sidebar/add_product.php",
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
                if (response.message === "success") {
                    $("#successMessage").show();
                    $("#addProductForm")[0].reset();

                    let newRow = `
                        <tr id="row-${response.id}">
                            <td>${response.id}</td>
                            <td>${response.product_name}</td>
                            <td>${response.product_description}</td>
                            <td>₱${parseFloat(response.price).toFixed(2)}</td>
                            <td>${response.stock_quantity}</td>
                            <td>${response.size}</td>
                            <td>
                                <button class="btn btn-danger delete-btn" data-id="${response.id}">Delete</button>
                            </td>
                        </tr>
                    `;
                    $("#productTableBody").append(newRow);

                    setTimeout(function() {
                        $("#successMessage").fadeOut();
                    }, 1000);
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert("An error occurred while adding the product.");
            }
        });
    });

    // Handle product deletion via AJAX
    $(document).on("click", ".delete-btn", function() {
        let productId = $(this).data("id");
        let row = $(this).closest("tr");

        if (confirm("Are you sure you want to delete this product?")) {
            $.ajax({
                url: "sidebar/delete_product.php",
                type: "GET",
                data: { id: productId },
                dataType: "json",
                success: function(response) {
                    if (response.message === "success") {
                        row.fadeOut(); // Remove row from table
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert("An error occurred while deleting the product.");
                }
            });
        }
    });

    // Hide success message when modal opens again
    $("#addProductModal").on("show.bs.modal", function() {
        $("#successMessage").hide();
    });
});
</script>

</body>
</html>
