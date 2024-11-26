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
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm fixed-top">
    <div class="container">
        <a href="index.php" class="navbar-brand text-primary font-weight-bold">
            <i class="fas fa-tools"></i> FixIT
        </a>
        <span class="navbar-text text-muted font-italic d-none d-md-inline">
        Simplifying Computer Repairs For You
        </span>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#myMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="myMenu">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="index.php" class="nav-link text-dark font-weight-bold">
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#Services" class="nav-link text-dark font-weight-bold">
                        Services
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#registration" class="nav-link text-dark font-weight-bold">
                        Registration
                    </a>
                </li>
                <li class="nav-item">
                    <a href="Requester/RequesterLogin.php" class="nav-link text-dark font-weight-bold">
                        Login
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#Contact" class="nav-link text-dark font-weight-bold">
                        Contact
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navigation -->



  <!-- Start Header Jumbotron -->
<header class="jumbotron back-image text-center d-flex flex-column align-items-center justify-content-center" 
    style="background-image: url('images/b10.jpg'); height: 100vh; background-size: cover; background-position: center; background-color: #e0f7fa;">
    <div class="mainHeading text-center">
        <h1 class="display-3 font-weight-bold mb-3" style="color: #004d40; text-shadow: 2px 2px 5px rgba(0,0,0,0.2);">
            Welcome to <span style="color: #26a69a;">FixIT</span>
        </h1>
        <p class="lead font-italic mb-4" style="color: #004d40; text-shadow: 1px 1px 3px rgba(0,0,0,0.1);">
            SIMPLIFYING COMPUTER REPAIRS FOR YOU
        </p>
        <div class="button-group">
            <a href="Requester/RequesterLogin.php" class="btn btn-lg btn-success mx-2 px-4 py-2 shadow-lg login-btn">
                Login
            </a>
            <a href="#registration" class="btn btn-lg btn-primary mx-2 px-4 py-2 shadow-lg signup-btn">
                Sign Up
            </a>
        </div>
    </div>
</header>
<!-- End Header Jumbotron -->







  <div class="container">
    <!--Introduction Section-->
    <div class="jumbotron">
      <h3 class="text-center">FixIT Services</h3>
      <p class="text-justify">
      FixIT is a platform dedicated to offering quick and reliable solutions for all your computer-related issues. 
      Our services connect users with expert technicians to diagnose, troubleshoot, and repair hardware and software problems efficiently.
       We specialize in system optimization, virus removal, and hardware component repair. 
       With a user-friendly interface, FixIT ensures seamless communication between users and technicians, enabling fast service delivery. 
       Our mission is to minimize downtime and maximize customer satisfaction by providing top-notch technical support.
      </p>

    </div>
  </div>
  <!--Introduction Section End-->
  <!-- Start Services -->
  <div class="container text-center border-bottom" id="Services">
    <h2>Our Services</h2>
    <div class="row mt-4">
      <div class="col-sm-4 mb-4">
        <a href="#"><i class="fas fa-tv fa-8x text-success"></i></a>
        <h4 class="mt-4">Electronic Appliances</h4>
      </div>
      <div class="col-sm-4 mb-4">
        <a href="#"><i class="fas fa-sliders-h fa-8x text-primary"></i></a>
        <h4 class="mt-4">Preventive Maintenance</h4>
      </div>
      <div class="col-sm-4 mb-4">
        <a href="#"><i class="fas fa-cogs fa-8x text-info"></i></a>
        <h4 class="mt-4">Fault Repair</h4>
      </div>
    </div>
  </div> <!-- End Services -->

  <!-- Start Registration  -->
  <?php include('userRegistration.php') ?>
  <!-- End Registration  -->

  <!-- Start Feedback -->
<div class="container mt-5">
    <h2 class="text-center mb-4">🌟 Happy Customers 🌟</h2>
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
                echo '<div class="card review-card shadow-sm border-0 text-center">';

                // Display user photo or default avatar
                $userPhoto = !empty($review['photo']) ? 'uploads/' . htmlspecialchars($review['photo']) : 'default-avatar.png';
                echo '<img src="' . $userPhoto . '" class="card-img-top rounded-circle mx-auto mt-3" alt="User Photo" 
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


  <!--Start Contact Us-->
  <div class="container" id="Contact">
    <!--Start Contact Us Container-->
    <h2 class="text-center mb-4">Contact Us</h2> <!-- Contact Us Heading -->
    <div class="row">

      <!--Start Contact Us Row-->
      <?php include('contactform.php'); ?>
      <!-- End Contact Us 1st Column -->

      <div class="col-md-4 text-center">
        <!-- Start Contact Us 2nd Column-->
        <strong>Headquarter:</strong> <br>
        OCSMS Pvt Ltd, <br>
        Sec IV, Bokaro <br>
        Jharkhand - 834005 <br>
        Phone: +00000000 <br>
        <a href="#" target="_blank">www.ocsms.com</a> <br>

        <br><br>
        <strong>Delhi Branch:</strong> <br>
        OCSMS Pvt Ltd, <br>
        Ashok Nagar, Delhi <br>
        Delhi - 804002 <br>
        Phone: +00000000 <br>
        <a href="#" target="_blank">www.ocsms.com</a> <br>
      </div> <!-- End Contact Us 2nd Column-->
    </div> <!-- End Contact Us Row-->
  </div> <!-- End Contact Us Container-->
  <!-- End Contact Us -->

  <!-- Start Footer-->
  <footer class="container-fluid bg-dark text-white mt-5" style="border-top: 3px solid #DC3545;">
    <div class="container">
      <!-- Start Footer Container -->
      <div class="row py-3">
        <!-- Start Footer Row -->
        <div class="col-md-6">
          <!-- Start Footer 1st Column -->
          <span class="pr-2">Follow Us: </span>
          <a href="#" target="_blank" class="pr-2 fi-color"><i class="fab fa-facebook-f"></i></a>
          <a href="#" target="_blank" class="pr-2 fi-color"><i class="fab fa-twitter"></i></a>
          <a href="#" target="_blank" class="pr-2 fi-color"><i class="fab fa-youtube"></i></a>
          <a href="#" target="_blank" class="pr-2 fi-color"><i class="fab fa-google-plus-g"></i></a>
          <a href="#" target="_blank" class="pr-2 fi-color"><i class="fas fa-rss"></i></a>
        </div> <!-- End Footer 1st Column -->

        <div class="col-md-6 text-right">
          <!-- Start Footer 2nd Column -->
          <small> Designed by DBMS team &copy; 2024.
          </small>
          <small class="ml-2"><a href="Admin/login.php">Admin Login</a></small>
        </div> <!-- End Footer 2nd Column -->
      </div> <!-- End Footer Row -->
    </div> <!-- End Footer Container -->
  </footer> <!-- End Footer -->

  <!-- Boostrap JavaScript -->
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/all.min.js"></script>
</body>

</html>