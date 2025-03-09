<?php
include("../../../dB/config.php");

// Fetch data from the database (Example Queries)
$weekly_sales = 25000;  // Example: Fetch from DB
$weekly_orders = 45;     // Example: Fetch from DB
$visitors_online = 12;   // Example: Fetch from DB

// Sample sales data (Modify with real DB queries)
$sales_data = [1200, 1500, 1300, 2000, 1800, 2200, 1900]; // Example values for the last 7 days
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js -->

    <style>
        body {
            background-color: #F6F0F0;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
        }

        .container-fluid {
            padding: 30px;
            flex-grow: 1;
        }

        h2 {
            text-align: left;
            color:  #735240;
            font-weight: bold;
            margin-bottom: 20px;
            font-size: 28px;
        }

        /* Dashboard Cards */
        .dashboard-card {
            border: none;
            border-radius: 15px;
            color: white;
            padding: 20px;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.1);
        }

        .dashboard-card h4 {
            margin: 0;
            font-size: 22px;
        }

        .dashboard-card .card-footer {
            font-size: 18px;
            font-weight: bold;
        }

        .card-sales { background: linear-gradient(135deg, #A66E38, #AB886D); } /* Brown */
        .card-orders { background: linear-gradient(135deg, #A67C52, #6E4E32); } /* Coffee */
        .card-visitors { background: linear-gradient(135deg, #D5B89D, #A47E5C); } /* Beige */
        /* Chart Container */
        .chart-container {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 3px 3px 15px rgba(0, 0, 0, 0.1);
        }

        .chart-container h4 {
            font-size: 20px;
            color: #4E342E;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
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
    <h2>Admin Dashboard</h2>

    <div class="row">
        <!-- Weekly Sales -->
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card dashboard-card card-sales mb-4">
                <div class="card-body">
                    <h5>Weekly Sales (₱)</h5>
                    <h4>₱<?php echo number_format($weekly_sales); ?></h4>
                </div>
            </div>
        </div>

        <!-- Weekly Orders -->
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card dashboard-card card-orders mb-4">
                <div class="card-body">
                    <h5>Weekly Orders</h5>
                    <h4><?php echo $weekly_orders; ?></h4>
                </div>
            </div>
        </div>

        <!-- Visitors Online -->
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card dashboard-card card-visitors mb-4">
                <div class="card-body">
                    <h5>Visitors Online</h5>
                    <h4><?php echo $visitors_online; ?></h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Sales Statistics Chart -->
    <div class="row">
        <div class="col-lg-12">
            <div class="chart-container">
                <h4>Sales Statistics (Last 7 Days)</h4>
                <canvas id="salesChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
// Sales Data (from PHP to JavaScript)
var salesData = <?php echo json_encode($sales_data); ?>;

// Render Chart
var ctx = document.getElementById("salesChart").getContext("2d");
var salesChart = new Chart(ctx, {
    type: "line",
    data: {
        labels: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
        datasets: [{
            label: "Sales (₱)",
            data: salesData,
            backgroundColor: "rgba(78, 52, 46, 0.2)",
            borderColor: "#4E342E",
            borderWidth: 3,
            pointRadius: 5,
            pointHoverRadius: 8,
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false }
        },
        scales: {
            x: { grid: { display: false } },
            y: { beginAtZero: true, grid: { color: "#E0E0E0" } }
        }
    }
});
</script>

</body>
</html>
