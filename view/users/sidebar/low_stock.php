<?php
include("../../../dB/config.php");

$query = "SELECT id, product_name, stock_quantity FROM products WHERE stock_quantity <= 5 ORDER BY stock_quantity ASC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Low Stock Alerts</title>

    <!-- Bootstrap & Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <style>
        body {
            background-color: #F6F0F0;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            padding: 30px;
        }

        h2 {
            color: #735240;
            font-weight: bold;
        }

        .low-stock-container {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .low-stock-item {
            background: linear-gradient(135deg, #E8D1C5, #C7A17A);
            color: #5A3D2B;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 10px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: transform 0.2s ease-in-out;
        }

        .low-stock-item:hover {
            transform: scale(1.02);
            background: linear-gradient(135deg, #DCC3B1, #B98A64);
        }

        .low-stock-item .stock-count {
            background: white;
            padding: 5px 15px;
            border-radius: 5px;
            font-weight: bold;
            color: #735240;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.1);
        }

        .alert-success {
            background: #C9E4A3;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            font-weight: bold;
            color: #2E7D32;
        }

        .low-stock-icon {
            font-size: 1.5rem;
            margin-right: 10px;
            color: #735240;
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
    <h2 class="mb-4"><i class="fa-solid fa-triangle-exclamation"></i> Low Stock Alerts</h2>

    <div class="low-stock-container">
        <?php 
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="low-stock-item">
                        <div>
                            <i class="fa-solid fa-box-open low-stock-icon"></i>
                            <strong>' . $row['product_name'] . '</strong> is running low!
                        </div>
                        <span class="stock-count">Only ' . $row['stock_quantity'] . ' left</span>
                      </div>';
            }
        } else {
            echo '<div class="alert alert-success"><i class="fa-solid fa-check-circle"></i> ✅ All products have sufficient stock.</div>';
        }
        ?>
    </div>
</div>

</body>
</html>
