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
      padding: 10px;
      border-radius: 8px;
      transition: background 0.3s ease;
    }

    .sidebar-nav .nav-item a:hover {
      background-color: #EAE3E3;
    }

    /* Icons */
    .sidebar-nav .nav-item a i {
      color: #735240 !important;
    }

    /* Greeting Message */
    .greeting {
    margin: 9px 0 9px 5px;
    text-align: left;
    color: #735240;
    font-size: 20px; /* Adjust this value as needed */
    font-family: Georgia, serif;
    }
  </style>
</head>

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
  <p class="greeting" id="greetingMessage"></p>

  <ul class="sidebar-nav">
    <!-- Dashboard -->
    <li class="nav-item">
      <a class="nav-link" href="dashboard.php">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <!-- Inventory -->
    <li class="nav-item">
      <a class="nav-link" href="inventory.php">
        <i class="bi bi-box"></i>
        <span>Inventory</span>
      </a>
    </li>

    <!-- Orders -->
    <li class="nav-item">
      <a class="nav-link" href="sidebar/orders.php">
        <i class="bi bi-box"></i>
        <span>Orders</span>
      </a>
    </li>

    <!-- Add New Product -->
    <li class="nav-item">
      <a class="nav-link" href="sidebar/add_product.php">
        <i class="bi bi-plus-circle"></i>
        <span>Add New Product</span>
      </a>
    </li>

    <!-- Customer -->
    <li class="nav-item">
      <a class="nav-link" href="sidebar/customer.php">
        <i class="bi bi-person"></i>
        <span>Customer</span>
      </a>
    </li>
  </ul>
</aside>

<main id="main" class="main">
  <!-- Main content here -->
</main>

<!-- Greeting script -->
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
</script>