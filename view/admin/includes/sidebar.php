<head>
  <style>
    /* Sidebar Base */
    .sidebar {
      background-color: #F6F0F0 !important; /* Same as header */
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
      color: #735240 !important; /* Font color updated */
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
      color: #735240 !important; /* Icon color updated */
      font-size: 1.2rem;
      margin-right: 10px;
    }

    /* Dropdown Menu */
    .nav-content {
      list-style: none;
      padding-left: 20px;
      margin: 5px 0 0;
    }
    
    .nav-content li a {
      padding: 8px 15px;
      font-weight: normal;
      display: flex;
      align-items: center;
      border-radius: 6px;
      transition: background 0.3s ease;
      color: #735240 !important; /* Font color updated */
    }
    
    .nav-content li a:hover {
      background-color: #EAE3E3;
    }
    
    /* Chevron arrow alignment */
    .ms-auto {
      margin-left: auto;
    }
  </style>
</head>

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">

    <!-- Dashboard -->
    <li class="nav-item">
      <a class="nav-link" href="index.html">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <!-- Products -->
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#products-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-box-seam"></i>
        <span>Products</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="products-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a class="nav-link" href="sidebar/add_product.php">
            <i class="bi bi-plus-circle"></i>
            <span>Add New Product</span>
          </a>
        </li>
        <li>
          <a href="manage-listings.html">
            <i class="bi bi-list-check"></i>
            <span>Manage Listings</span>
          </a>
        </li>
        <li>
          <a href="inventory-tracking.html">
            <i class="bi bi-archive"></i>
            <span>Inventory Tracking</span>
          </a>
        </li>
      </ul>
    </li><!-- End Products Nav -->

    <!-- Orders -->
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#orders-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-receipt"></i>
        <span>Orders</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="orders-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="new-orders.html">
            <i class="bi bi-cart-plus"></i>
            <span>New Orders</span>
          </a>
        </li>
        <li>
          <a href="processing-orders.html">
            <i class="bi bi-hourglass-split"></i>
            <span>Processing Orders</span>
          </a>
        </li>
        <li>
          <a href="completed-orders.html">
            <i class="bi bi-check-circle"></i>
            <span>Completed Orders</span>
          </a>
        </li>
        <li>
          <a href="canceled-orders.html">
            <i class="bi bi-x-circle"></i>
            <span>Canceled Orders</span>
          </a>
        </li>
      </ul>
    </li><!-- End Orders Nav -->

  </ul>
</aside><!-- End Sidebar -->

<main id="main" class="main">
  <!-- Main content goes here -->
</main>
