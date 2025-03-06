admin dash

<?php
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");
?>

<style>
    /* Match Background with Sidebar & Header */
    body {
        background-color: #F6F0F0 !important;
    }

    .main {
        background-color: #F6F0F0 !important;
        padding: 20px;
        min-height: 100vh;
        margin-left: 250px; /* Adjust according to sidebar width */
    }

    /* Page Title */
    .pagetitle h1 {
        color: #735240;
        font-weight: bold;
        margin-bottom: 20px;
    }

    /* Card Styling */
    .card {
        background: white;
        border-radius: 12px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        border: none;
        padding: 15px;
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: scale(1.02);
    }

    .card-title {
        color: #735240;
        font-weight: bold;
        font-size: 18px;
        margin-bottom: 10px;
    }

    .icon {
        font-size: 30px;
        color: #735240;
        margin-right: 10px;
    }

    h3 {
        color: #735240;
        font-weight: bold;
        font-size: 24px;
    }

    /* Chart Container */
    canvas {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* Sidebar Fix */
    #sidebar {
        position: fixed;
        height: 100%;
        width: 250px;
        background: #F6F0F0;
        border-right: 2px solid #E0D6D6;
    }

    /* Fix Main Content Overflow */
    .dashboard .row {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }
</style>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
    </div><!-- End Page Title -->

    <section class="dashboard">
        <div class="row">

            <!-- Dashboard Cards -->
            <div class="col-lg-4 col-md-6">
                <div class="card info-card">
                    <div class="card-body">
                        <h5 class="card-title">Total Products</h5>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-box-seam icon"></i>
                            <h3>120</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card info-card">
                    <div class="card-body">
                        <h5 class="card-title">New Orders</h5>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-cart-plus icon"></i>
                            <h3>15</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card info-card">
                    <div class="card-body">
                        <h5 class="card-title">Completed Orders</h5>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle icon"></i>
                            <h3>75</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order History Chart -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Monthly Sales</h5>
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
            </div><!-- End Sales Chart -->

        </div><!-- End Row -->
    </section>
</main><!-- End Main -->

<!-- Chart.js for Monthly Sales -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  var ctx = document.getElementById('salesChart').getContext('2d');
  var salesChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
          datasets: [{
              label: 'Sales',
              data: [120, 135, 150, 170, 180, 220, 250, 270, 290, 310, 330, 350],
              borderColor: '#735240',
              backgroundColor: 'rgba(115, 82, 64, 0.2)',
              fill: true,
              tension: 0.3
          }]
      },
      options: {
          responsive: true,
          plugins: {
              legend: {
                  labels: {
                      color: "#735240",
                      font: { size: 14 }
                  }
              }
          },
          scales: {
              x: {
                  ticks: { color: "#735240" },
                  grid: { color: "#E0D6D6" }
              },
              y: {
                  beginAtZero: true,
                  ticks: { color: "#735240" },
                  grid: { color: "#E0D6D6" }
              }
          }
      }
  });
</script>

<?php
include("./includes/footer.php");
?>
