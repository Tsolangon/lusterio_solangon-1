<head>
  <style>
    body {
      background-color: #F6F0F0;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      font-family: 'Poppins', sans-serif;
    }

    /* Sidebar Base */
    .sidebar {
      background-color: #F6F0F0 !important;
      padding: 15px;
      width: 250px;
      min-height: 100vh;
      border-right: 2px solid #E0D6D6;
    }

    /* Sidebar Navigation */
    .sidebar-nav {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .sidebar-nav .nav-item {
      margin-bottom: 10px;
    }

    .sidebar-nav .nav-item a {
      color: #735240 !important;
      font-weight: bold;
      display: flex;
      align-items: center;
      text-decoration: none;
      padding: 10px 15px;
      border-radius: 8px;
      transition: background 0.3s ease;
    }

    .sidebar-nav .nav-item a:hover {
      background-color: #EAE3E3;
    }

    /* Icons */
    .sidebar-nav .nav-item a i {
      color: #735240 !important;
      font-size: 1.2rem;
      margin-right: 10px;
    }

    /* Greeting Message */
    .greeting {
      font-size: 20px;
      font-weight: 500;
      font-family: Georgia, serif;
      color: #735240;
      margin: 9px 0 9px 5px;
      text-align: left;
    }
  </style>
</head>

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
  <p class="greeting" id="greetingMessage"></p> <!-- Greeting Message -->
  <ul class="sidebar-nav" id="sidebar-nav">

    <!-- Dashboard -->
    <li class="nav-item">
      <a class="nav-link" href="#" id="loadDashboard">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <!-- Inventory -->
    <li class="nav-item">
      <a class="nav-link" href="#" id="loadInventory">
        <i class="bi bi-box"></i>
        <span>Inventory</span>
      </a>
    </li>

    <!-- Orders -->
    <li class="nav-item">
      <a class="nav-link" href="#" id="loadOrders">
        <i class="bi bi-cart"></i>
        <span>Orders</span>
      </a>
    </li>

    <!-- Add New Product -->
    <li class="nav-item">
      <a class="nav-link" href="#" id="loadAddProduct">
        <i class="bi bi-plus-circle"></i>
        <span>Add New Product</span>
      </a>
    </li>

    <!-- Customer -->
    <li class="nav-item">
      <a class="nav-link" href="#" id="loadCustomer">
        <i class="bi bi-person"></i>
        <span>Customer</span>
      </a>
    </li>

  </ul>
</aside>

<main id="main" class="main">
  <!-- Content will be loaded here -->
</main>

<!-- jQuery for AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  function getGreeting() {
    let hour = new Date().getHours();
    let greeting = "";

    if (hour < 12) {
      greeting = "Hi, Good Morning!";
    } else if (hour < 18) {
      greeting = "Hi, Good Afternoon!";
    } else {
      greeting = "Hi, Good Evening!";
    }

    document.getElementById("greetingMessage").innerText = greeting;
  }

  getGreeting();

  $(document).ready(function() {
    // Load pages dynamically
    $("#loadDashboard").click(function(event) {
      event.preventDefault();
      $("#main").load("sidebar/dashboard.php");
    });

    $("#loadInventory").click(function(event) {
      event.preventDefault();
      $("#main").load("sidebar/inventory.php");
    });

    $("#loadOrders").click(function(event) {
      event.preventDefault();
      $("#main").load("sidebar/orders.php");
    });

    $("#loadAddProduct").click(function(event) {
      event.preventDefault();
      $("#main").load("sidebar/add_product.php");
    });

    $("#loadCustomer").click(function(event) {
      event.preventDefault();
      $("#main").load("sidebar/customer.php");
    });
  });
</script>
