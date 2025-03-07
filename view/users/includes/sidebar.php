<style>
  /* Match Sidebar Theme with Header */
  .sidebar {
    background-color: #F6F0F0 !important; /* Same as header */
    border-right: 2px solid #E0D6D6; /* Soft border */
    padding: 15px 10px;
    width: 250px;
    min-height: 100vh;
    box-shadow: 4px 0 10px rgba(0, 0, 0, 0.05); /* Soft shadow for depth */
  }

  /* Sidebar Navigation */
  .sidebar-nav {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  /* Sidebar Nav Items */
  .sidebar-nav .nav-item {
    margin-bottom: 10px;
  }

  .sidebar-nav .nav-item a {
    color: #735240 !important; /* Match text color */
    padding: 12px 15px;
    display: flex;
    align-items: center;
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.3s ease-in-out;
  }

  /* Sidebar Icons */
  .sidebar-nav .nav-item a i {
    color: #735240 !important; /* Match icon color */
    font-size: 1.3rem;
    margin-right: 10px;
  }

  /* Active Sidebar Link */
  .sidebar-nav .nav-item a:hover,
  .sidebar-nav .nav-item a.active {
    background-color: #EAE3E3 !important; /* Light hover effect */
    box-shadow: inset 3px 3px 6px rgba(0, 0, 0, 0.1);
    transform: translateX(5px);
  }

  /* Greeting Message (Now aligned to the left) */
  .greeting {
    font-size: 20px;
    font-weight: 500;
    font-family: Georgia, serif;
    color: #735240;
    margin: 9px 0 9px 5px; /* Moves text closer to the left */
    text-align: left;
  }
</style>

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
  <div class="greeting" id="greetingMessage"></div> <!-- Greeting Message -->

  <ul class="sidebar-nav" id="sidebar-nav">
    
  <ul class="sidebar-nav" id="sidebar-nav">
  
  <li class="nav-item">
    <a class="nav-link" href="dashboard.html">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->

  <li class="nav-item">
    <a class="nav-link" href="inventory.html">
      <i class="bi bi-box"></i>
      <span>View/Update Inventory</span>
    </a>
  </li><!-- End View/Update Inventory Nav -->

  <li class="nav-item">
    <a class="nav-link" href="manage-orders.html">
      <i class="bi bi-cart-check"></i>
      <span>Manage Order</span>
    </a>
  </li><!-- End Manage Order Nav -->

  <li class="nav-item">
    <a class="nav-link" href="analytics.html">
      <i class="bi bi-bar-chart"></i>
      <span>Analytics</span>
    </a>
  </li><!-- End Analytics Nav -->

</ul>
</aside><!-- End Sidebar -->

<main id="main" class="main">

<script>
    function getGreeting() {
        let hour = new Date().getHours();
        let greeting = "";

        if (hour < 12) {
            greeting = "Hi, Good Morning!";
        } else if (hour >= 12 && hour < 18) {
            greeting = "Hi, Good Afternoon!";
        } else {
            greeting = "Hi, Good Evening!";
        }

        document.getElementById("greetingMessage").innerText = greeting;
    }

    getGreeting(); // Call function to set greeting message
</script>
