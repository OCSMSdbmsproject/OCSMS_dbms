<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="css/all.min.css">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/custom.css">

  <title>FixIT</title>
</head>

<body>
  <!-- Start Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top">
  <div class="container">
    <a href="index.php" class="navbar-brand text-primary font-weight-bold">
      FixIT
    </a>
    <span class="navbar-text text-muted font-italic" style="white-space: nowrap;">
  Simplifying Computer Repairs For You
</span>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#myMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="myMenu">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a href="index.php" class="nav-link">Home</a>
        </li>
        <li class="nav-item">
          <a href="#Services" class="nav-link">Services</a>
        </li>
        <li class="nav-item">
          <a href="#registration" class="nav-link">Registration</a>
        </li>
        <li class="nav-item">
          <a href="Requester/RequesterLogin.php" class="nav-link">Login</a>
        </li>
        <li class="nav-item">
          <a href="#Contact" class="nav-link">Contact</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- End Navigation -->




<!-- Start Header Jumbotron -->
<header class="jumbotron back-image text-center d-flex flex-column align-items-center justify-content-start" 
    style="background-image: url('images/B13.png'); height: 100vh; background-size: cover; background-position: center; background-color: #e0f7fa;">
    <div class="mainHeading text-center" 
        style="position: absolute; top: 40%; right: 10%; transform: translate(0, -50%);">
        <h1 class="display-3 font-weight-bold mb-3" style="color: #004d40; text-shadow: 2px 2px 5px rgba(0,0,0,0.2);">
            Welcome to <span style="color: #26a69a;">FixIT</span>
        </h1>
        <p class="lead font-italic mb-2" style="color: #004d40; text-shadow: 1px 1px 3px rgba(0,0,0,0.1);">
            SIMPLIFYING COMPUTER REPAIRS FOR YOU!
        </p>
        <p class="slightly-bigger-text" style="color: #004d40; font-size: 1.2rem; margin-bottom: 1.5rem;">
            Our platform focuses on building trust by delivering<br>consistent and high-quality services tailored for your needs.
        </p>
        <div class="button-group">
            <a href="Requester/RequesterLogin.php" class="btn btn-lg login-btn mx-2 px-4 py-2 shadow-lg">
                Login
            </a>
            <a href="#registration" class="btn btn-lg signup-btn mx-2 px-4 py-2 shadow-lg">
                Sign Up
            </a>
        </div>
    </div>
</header>
<!-- End Header Jumbotron -->












  <!-- Start Introduction Section -->
<div class="container my-5" id="Services">
  <div class="jumbotron custom-jumbotron">
    <h3 class="text-center display-4 custom-heading">FixIT SERVICES</h3>
    <p class="text-justify custom-text">
      FixIT is a platform dedicated to offering quick and reliable solutions for all your computer-related issues. 
      Our services connect users with expert technicians to diagnose, troubleshoot, and repair hardware and software problems efficiently. 
      We specialize in system optimization, virus removal, and hardware component repair. With a user-friendly interface, FixIT ensures seamless communication between users and technicians, enabling fast service delivery. 
      Our mission is to minimize downtime and maximize customer satisfaction by providing top-notch technical support. Additionally, we offer tailored maintenance packages to keep your systems running smoothly over the long term. 
      FixIT also provides 24/7 customer support to address urgent issues anytime. We use advanced diagnostic tools and techniques to ensure accurate and effective repairs. 
      Trust FixIT to deliver affordable, efficient, and expert solutions for all your tech needs.
    </p>
  </div>
</div>
<!-- End Introduction Section -->

<!-- Start Services Section -->
<div class="container text-center border-bottom" >
  <div class="row mt-5">
    <div class="col-sm-4 mb-4 service-item">
      <a href="#" class="service-link">
        <i class="fas fa-tv fa-6x text-primary service-icon"></i>
      </a>
      <h4 class="mt-4">Electronic Appliances</h4>
    </div>
    <div class="col-sm-4 mb-4 service-item">
      <a href="#" class="service-link">
        <i class="fas fa-sliders-h fa-6x text-warning service-icon"></i>
      </a>
      <h4 class="mt-4">Preventive Maintenance</h4>
    </div>
    <div class="col-sm-4 mb-4 service-item">
      <a href="#" class="service-link">
        <i class="fas fa-cogs fa-6x text-success service-icon"></i>
      </a>
      <h4 class="mt-4">Fault Repair</h4>
    </div>
  </div>
</div>
<!-- End Services Section -->

<div>
  <!-- Start Registration  -->
  <?php include('userRegistration.php') ?>
  <!-- End Registration  -->
</div>
  <!-- Start Feedback -->
  <div class="container mt-5">
    <h2 class="text-center mb-4 text-primary">🌟 Happy Customers 🌟</h2>
    <div class="row justify-content-center">
        <?php
        // Fetch top reviews (e.g., top 4 highest-rated)
        $reviewsSql = "SELECT r.comment, r.photo, r.rating, rl.r_name 
                       FROM reviews_tb AS r 
                       INNER JOIN requesterlogin_tb AS rl ON r.user_id = rl.r_login_id 
                       ORDER BY r.rating DESC LIMIT 4";

        $reviewsResult = $conn->query($reviewsSql);

        if ($reviewsResult->num_rows > 0) {
            while ($review = $reviewsResult->fetch_assoc()) {
                echo '<div class="col-md-3 col-sm-6 mb-4">';
                echo '<div class="card review-card shadow-lg border-0 text-center">';
                
                // Display user photo or default avatar
                $userPhoto = !empty($review['photo']) ? 'uploads/' . htmlspecialchars($review['photo']) : 'default-avatar.png';
                echo '<img src="' . $userPhoto . '" class="card-img-top rounded-circle mx-auto mt-3 user-photo" alt="User Photo" 
                        style="height: 120px; width: 120px; object-fit: cover; border: 3px solid #f8f9fa;">';

                echo '<div class="card-body">';
                echo '<h5 class="card-title font-weight-bold">' . htmlspecialchars($review['r_name']) . '</h5>';
                echo '<p class="card-text text-muted small">' . htmlspecialchars($review['comment']) . '</p>';
                echo '<p class="text-warning mb-0">' . str_repeat('★', $review['rating']) . str_repeat('☆', 5 - $review['rating']) . '</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p class="text-center text-muted">No reviews yet! Be the first to share your feedback.</p>';
        }
        ?>
    </div>
</div>
<!-- End Feedback -->



<div>
  <!-- Start Contact  -->
  <?php include('Contact.php') ?>
  <!-- End Contact  -->
</div>






 <!-- Start Footer-->
 <footer class="container-fluid bg-dark text-white mt-5" style="border-top: 3px solid #DC3545;">
  <div class="container" style="max-width: 1100px;"> <!-- Adjusted max-width -->
    <!-- Start Footer Container -->
    <div class="row py-4">
      <!-- Start Footer Row -->
      
      <!-- Footer Column 1: Social Media Links -->
      <div class="col-md-6">
        <div class="d-flex align-items-center">
          <span class="mr-3" style="font-weight: bold; font-size: 1.1rem;">Follow Us:</span>
          <a href="#" target="_blank" class="social-icon pr-3"><i class="fab fa-facebook-f"></i></a>
          <a href="#" target="_blank" class="social-icon pr-3"><i class="fab fa-twitter"></i></a>
          <a href="#" target="_blank" class="social-icon pr-3"><i class="fab fa-youtube"></i></a>
          <a href="#" target="_blank" class="social-icon pr-3"><i class="fab fa-google-plus-g"></i></a>
          <a href="#" target="_blank" class="social-icon pr-3"><i class="fab fa-github"></i></a>
        </div>
      </div> <!-- End Footer Column 1 -->

      <!-- Footer Column 2: Footer Text & Admin Login -->
      <div class="col-md-6 text-md-right text-center mt-3 mt-md-0" style="white-space: nowrap;">
        <small style="font-size: 0.9rem; opacity: 0.8;">Designed by DBMS team &copy; 2024</small>
        <small class="ml-2">
          <a href="Admin/login.php" class="admin-login-btn">
            Admin Login
          </a>
        </small>
      </div> <!-- End Footer Column 2 -->
    </div> <!-- End Footer Row -->
  </div> <!-- End Footer Container -->
</footer> <!-- End Footer -->

<!-- Footer Styling -->
<style>
  /* Admin Login Button Styling */
  .admin-login-btn {
      color: #fff; /* White color for the Admin Login link by default */
      font-weight: bold;
      transition: color 0.3s ease;
      text-decoration: none; /* Remove underline from the link */
  }

  .admin-login-btn:hover {
      color: #DC3545; /* Red color on hover */
      text-decoration: none; /* Optional: remove underline */
  }
</style>




  <!-- Boostrap JavaScript -->
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/all.min.js"></script>
</body>

</html>