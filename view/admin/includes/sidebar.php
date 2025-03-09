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
  </style>
</head>

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">

<!-- Dashboard -->
<li class="nav-item">
  <a class="nav-link" href="#" id="loadDashboard">
    <i class="bi bi-grid"></i>
    <span>Dashboard</span>
  </a>
</li><!-- End Dashboard Nav -->

    <!-- User Management -->
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#user-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-people"></i>
        <span>User Management</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="user-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a class="nav-link" href="#" id="loadAddUser">
            <i class="bi bi-person-plus"></i>
            <span>Add User</span>
          </a>
        </li>
        <li>
          <a class="nav-link" href="#" id="loadUserList">
            <i class="bi bi-list"></i>
            <span>User List</span>
          </a>
        </li>
        <li>
      </ul>
    </li><!-- End User Management Nav -->

  </ul>
</aside><!-- End Sidebar -->

<main id="main" class="main">
  <!-- Content will be loaded here -->
</main>

<!-- jQuery for AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // Load "Dashboard" page dynamically
    $("#loadDashboard").click(function(event) {
      event.preventDefault(); // Prevent default link behavior
      $("#main").load("sidebar/dashboard.php"); // Load dashboard.php inside #main
    });

    // Load "Add User" page dynamically
    $("#loadAddUser").click(function(event) {
      event.preventDefault();
      $("#main").load("sidebar/add_user.php");
    });

    // Load "User List" page dynamically
    $("#loadUserList").click(function(event) {
      event.preventDefault();
      $("#main").load("sidebar/user_list.php");
    });
  });
</script>

