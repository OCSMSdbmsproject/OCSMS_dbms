<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>
  <?php echo TITLE ?>
 </title>
 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="../css/bootstrap.min.css">

 <!-- Font Awesome CSS -->
 <link rel="stylesheet" href="../css/all.min.css">

 <!-- Custome CSS -->
 <link rel="stylesheet" href="../css/custom.css">

</head>

<body>
 <!-- Top Navbar -->
 <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #acedf6; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
  <div class="container d-flex align-items-center" style="padding-left: 0;">
    <!-- Brand Name and Tagline Together -->
    <a href="index.php" class="navbar-brand d-flex align-items-center text-primary font-weight-bold" style="font-size: 1.8rem; letter-spacing: 1px;">
      <i style="margin-left: -350px;"></i>
      <span>FixIT</span>
      <span class="text-muted ml-2 font-italic" style="font-size: 1rem;">- Simplifying Computer Repairs For You</span>
    </a>
  </div>
</nav>

<style>
    body {
    margin: 0;
    font-family: Arial, sans-serif;
}

.navbar {
    background-color: #acedf6; /* Light blue background */
    display: flex;
    align-items: center;
    justify-content: space-between; /* Ensures content aligns properly */
    padding: 15px 30px; /* Increases padding for larger navbar */
    height: 80px; /* Slightly increases height */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.logo {
    display: flex;
    flex-direction: column;
}

.brand {
    font-size: 28px; /* Larger font for the brand name */
    font-weight: bold;
    color: #007bff; /* Blue color */
    margin: 0;
}

.tagline {
    font-size: 16px; /* Slightly larger tagline text */
    font-style: italic;
    color: #555; /* Gray color for tagline */
    margin-top: 5px;
}
@media (min-width: 992px) {
  .navbar-nav .nav-item {
    margin-left: 20px; /* Spacing between items on larger screens */
  }
}


</style>

 <!-- Side Bar -->
 <div class="container-fluid mb-5" style="margin-top:40px;">
  <div class="row">
   <nav class="col-sm-3 col-md-2 bg-light sidebar py-5 d-print-none">
    <div class="sidebar-sticky">
     <ul class="nav flex-column">
      <li class="nav-item">
       <a class="nav-link <?php if(PAGE == 'dashboard') { echo 'active'; } ?> " href="dashboard.php">
        <i class="fas fa-tachometer-alt"></i>
        Dashboard
       </a>
      </li>
      <li class="nav-item">
       <a class="nav-link <?php if(PAGE == 'work') { echo 'active'; } ?>" href="work.php">
        <i class="fab fa-accessible-icon"></i>
        Work Order
       </a>
      </li>
      <li class="nav-item">
       <a class="nav-link <?php if(PAGE == 'request') { echo 'active'; } ?>" href="request.php">
        <i class="fas fa-align-center"></i>
        Requests
       </a>
      </li>
      <li class="nav-item">
       <a class="nav-link <?php if(PAGE == 'assets') { echo 'active'; } ?>" href="assets.php">
        <i class="fas fa-database"></i>
        Assets
       </a>
      </li>
      <li class="nav-item">
       <a class="nav-link <?php if(PAGE == 'technician') { echo 'active'; } ?>" href="technician.php">
        <i class="fab fa-teamspeak"></i>
        Technician
       </a>
      </li>
      <li class="nav-item">
       <a class="nav-link <?php if(PAGE == 'requesters') { echo 'active'; } ?>" href="requester.php">
        <i class="fas fa-users"></i>
        Requester
       </a>
      </li>
      <li class="nav-item">
       <a class="nav-link <?php if(PAGE == 'sellreport') { echo 'active'; } ?>" href="soldproductreport.php">
        <i class="fas fa-table"></i>
        Sell Report
       </a>
      </li>
      <li class="nav-item">
       <a class="nav-link <?php if(PAGE == 'workreport') { echo 'active'; } ?>" href="workreport.php">
        <i class="fas fa-table"></i>
        Work Report
       </a>
      </li>
      <li class="nav-item">
       <a class="nav-link <?php if(PAGE == 'changepass') { echo 'active'; } ?>" href="changepass.php">
        <i class="fas fa-key"></i>
        Change Password
       </a>
      </li>
      <li class="nav-item">
       <a class="nav-link" href="../logout.php">
        <i class="fas fa-sign-out-alt"></i>
        Logout
       </a>
      </li>
     </ul>
    </div>
   </nav>