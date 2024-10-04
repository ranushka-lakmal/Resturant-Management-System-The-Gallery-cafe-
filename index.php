<!-- index.php -->

<?php
include 'template/header.php';
include 'dbCon.php'; // Include the database connection here
$con = connect();
session_start();

?>


<body>
  <style>
    /* Add custom styles for the map */
    #map {
            height: 400px; /* Adjust the height as needed */
            border-radius: 8px; /* Add rounded corners for aesthetics */
            overflow: hidden; /* Prevent overflow */
        }

        /* Optional: Style the container for better spacing */
        .map-container {
            margin: 20px 0; /* Add margin around the map */
        }
  </style>

  <?php include 'template/nav-bar.php'; ?>
  <!-- END nav -->

  <section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url('images/slide1.jpg'); background-color: #333;">
      <div class="overlay"></div>
      <div class="container">

      </div>
    </div>

    <div class="slider-item" style="background-image: url('images/slide2.jpg'); background-color: #333;">
      <div class="overlay"></div>

    </div>

    <div class="slider-item" style="background-image: url('images/slide3.jpg'); background-color: #333;">
      <div class="overlay"></div>

    </div>
  </section>
  <!-- END slider -->

  <?php include 'template/font-menu.php'; ?>

  
  <!-- Reservation Section -->
  <section id="reservation" class="ftco-section bg-dark text-light"
    style="background-image: url('images/order.jpg'); background-size: cover; background-position: center;">
    <div class="overlay" style="background: rgba(0, 0, 0, 0.7);"></div>
    <div class="container">
      <div class="row justify-content-center mb-5 pb-3">
        <div class="col-md-7 heading-section text-center ftco-animate">
          <h1 class="mb-4 text-uppercase" style="color:white"><b>Make a Food Order</b></h1>
          <p class="text-light">Order your food now and enjoy an exceptional dining experience.</p>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-6 d-flex justify-content-center align-items-center">
          <button class="btn btn-lg btn-primary reservation-btn py-3 px-5 ftco-animate fadeInUp"
            onclick="checkLoginAndOrderFood()">
            <i class="fas fa-concierge-bell mr-2"></i> Pre Order Your Food
          </button>
        </div>
      </div>
    </div>
  </section>
  <br>

  <!-- Reservation Section -->
  <section id="reservation" class="ftco-section bg-dark text-light"
    style="background-image: url('images/table-res.jpg'); background-size: cover; background-position: center;">
    <div class="overlay" style="background: rgba(0, 0, 0, 0.7);"></div>
    <div class="container">
      <div class="row justify-content-center mb-5 pb-3">
        <div class="col-md-7 heading-section text-center ftco-animate">
          <h1 class="mb-4 text-uppercase" style="color:white"><b>Make a Table Reservation</b></h1>
          <p class="text-light">Book your table now and enjoy an exceptional dining experience.</p>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-6 d-flex justify-content-center align-items-center">
          <button class="btn btn-lg btn-primary reservation-btn py-3 px-5 ftco-animate fadeInUp"
            onclick="checkLoginAndReserve()">
            <i class="fas fa-concierge-bell mr-2"></i> Reserve Your Table
          </button>
        </div>
      </div>
    </div>
  </section>


  <!-- Custom Script to Scroll to Reservation Form -->
  <script>
    function scrollToReservationForm() {
      $('html, body').animate({
        scrollTop: $('#reservation-form-section').offset().top
      }, 800);
    }
  </script>

  <!-- Custom Script for checking login and routing -->
  <script>
    function checkLoginAndReserve() {
      // Use AJAX to check if user is logged in
      <?php if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== TRUE): ?>
        // If user is not logged in, redirect to login page
        window.location.href = 'login.php';
      <?php else: ?>
        // If user is logged in, redirect to table-reservation.php
        window.location.href = 'table-reservation.php';
      <?php endif; ?>
    }
  </script>

   <!-- Custom Script for checking login and routing -->
   <script>
    function checkLoginAndOrderFood() {
      // Use AJAX to check if user is logged in
      <?php if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== TRUE): ?>
        // If user is not logged in, redirect to login page
        window.location.href = 'login.php';
      <?php else: ?>
        
        window.location.href = 'food-order.php';
      <?php endif; ?>
    }
  </script>

  <!-- FontAwesome for Icons -->
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>


  <?php include 'template/img.php'; ?>


    <!-- Optional: jQuery and Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <?php include 'template/footer.php'; ?>


  <?php include 'template/script.php'; ?>

  <script src="dashboard/assets/vendor/jquery/jquery.js"></script>
  <script src="dashboard/assets/vendor/select2/select2.js"></script>
  <script src="dashboard/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>

</body>

</html>