<?php
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");
?>

<style>
  /* Background Slideshow Styling */
  .slideshow-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    z-index: -1;
  }

  .slide {
    position: absolute;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    opacity: 0;
    transition: opacity 1.5s ease-in-out;
  }

  .slide.active {
    opacity: 1;
  }

  /* Overlay for readability */
  .overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.3); /* Softer transparent overlay */
    z-index: 0;
  }

  /* Centered Content Box */
  .content {
    position: relative;
    z-index: 2;
    text-align: center;
    background: rgba(255, 255, 255, 0.85);
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
    max-width: 450px;
    animation: fadeIn 1s ease-in-out;
    margin: auto;
  }

  /* Welcome Text */
  .content h1 {
    color: #5a3d2b;
    font-size: 28px;
    font-weight: bold;
  }

  .content p {
    color: #735240;
    font-size: 18px;
  }

  /* Animation Effect */
  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
  }

  /* Responsive Fixes */
  @media (max-width: 768px) {
    .content {
      width: 90%;
      padding: 20px;
    }
  }
</style>

<div class="slideshow-container">
  <div class="slide active" style="background-image: url('../../assets/img/beads.jpg');"></div>
  <div class="slide" style="background-image: url('../../assets/img/beads1.jpg');"></div>
  <div class="slide" style="background-image: url('../../assets/img/beads2.jpg');"></div>
</div>

<div class="overlay"></div>

<main id="main" class="main">
  <div class="content">
    <h1>Welcome to Celestia</h1>
    <p>Where beauty meets elegance.</p>
  </div>
</main>

<script>
  let slides = document.querySelectorAll('.slide');
  let index = 0;

  function nextSlide() {
    slides[index].classList.remove('active');
    index = (index + 1) % slides.length;
    slides[index].classList.add('active');
  }

  setInterval(nextSlide, 5000); // Change image every 5 seconds
</script>

<?php
include("./includes/footer.php");
?>
