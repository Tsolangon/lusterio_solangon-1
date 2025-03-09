<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Inventory List</title>

    <!-- Bootstrap & DataTables -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

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

        .table-container {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.1);
        }

        .table {
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 0;
        }

        .table thead th {
            background: #735240;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 14px;
            border: none;
        }

        .table td {
            text-align: center;
            vertical-align: middle;
            padding: 15px;
            font-size: 14px;
        }

        /* Remove Sorting Icons */
        .dataTables_wrapper .dataTables_length select, 
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #D5C4B1;
            border-radius: 6px;
            padding: 6px;
        }

        .dataTables_wrapper .dataTables_length select:focus,
        .dataTables_wrapper .dataTables_filter input:focus {
            outline: none;
            border-color: #735240;
            box-shadow: 0 0 8px rgba(115, 82, 64, 0.5);
        }

        /* Status Labels */
        .status {
            padding: 5px 10px;
            border-radius: 6px;
            font-weight: bold;
            display: inline-block;
            color: white;
        }

        .status-sell { background: #2ecc71; } /* Green */
        .status-offer { background: #f39c12; } /* Yellow */
        .status-out { background: #e74c3c; } /* Red */
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
    <h2>Stock Inventory List</h2>

    <div class="table-container">
        <table id="inventoryTable" class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Product Name</th>
                    <th class="text-center">Date Added</th>
                    <th class="text-center">Stock</th>
                    <th class="text-center">In Stock</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#SKUN111</td>
                    <td>Oculus VR</td>
                    <td>June 13, 2021</td>
                    <td>1455</td>
                    <td>451</td>
                    <td><span class="status status-offer">Offer Process</span></td>
                </tr>
                <tr>
                    <td>#SKUN112</td>
                    <td>Wall Clock</td>
                    <td>June 22, 2021</td>
                    <td>5555</td>
                    <td>1451</td>
                    <td><span class="status status-sell">Sell</span></td>
                </tr>
                <tr>
                    <td>#SKUN113</td>
                    <td>Flower Pot</td>
                    <td>June 16, 2021</td>
                    <td>555</td>
                    <td>11</td>
                    <td><span class="status status-sell">Sell</span></td>
                </tr>
                <tr>
                    <td>#SKUN114</td>
                    <td>Port Box</td>
                    <td>June 23, 2021</td>
                    <td>7581</td>
                    <td>2468</td>
                    <td><span class="status status-offer">Offer Process</span></td>
                </tr>
                <tr>
                    <td>#SKUN115</td>
                    <td>School Bag</td>
                    <td>June 18, 2021</td>
                    <td>1581</td>
                    <td>0</td>
                    <td><span class="status status-out">Out of Stock</span></td>
                </tr>
                <tr>
                    <td>#SKUN116</td>
                    <td>Rado Watch</td>
                    <td>June 13, 2021</td>
                    <td>4581</td>
                    <td>3468</td>
                    <td><span class="status status-sell">Sell</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {
    $("#inventoryTable").DataTable({
        "paging": true,
        "searching": true,
        "ordering": false, // Disable ordering to remove sorting icons
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
        
    });
});
</script>

</body>
</html>
