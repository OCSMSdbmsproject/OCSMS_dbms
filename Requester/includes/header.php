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
 <div class="container-fluid mb-5 " style="margin-top:40px;">
  <div class="row">
   <nav class="col-sm-2 sidebar py-5 d-print-none">
    <div class="sidebar-sticky">
     <ul class="nav flex-column">
      <li class="nav-item">
       <a class="nav-link <?php if(PAGE == 'RequesterProfile') { echo 'active'; } ?>" href="RequesterProfile.php">
        <i class="fas fa-user"></i>
        Profile <span class="sr-only">(current)</span>
       </a>
      </li>
      <li class="nav-item">
       <a class="nav-link <?php if(PAGE == 'SubmitRequest') { echo 'active'; } ?>" href="SubmitRequest.php">
        <i class="fab fa-accessible-icon"></i>
        Submit Request
       </a>
      </li>
      <li class="nav-item">
       <a class="nav-link <?php if(PAGE == 'CheckStatus') { echo 'active'; } ?>" href="CheckStatus.php">
        <i class="fas fa-align-center"></i>
        Service Status
       </a>
      </li>
      <li class="nav-item">
       <a class="nav-link <?php if(PAGE == 'ReviewService') { echo 'active'; } ?>" href="ReviewService.php">
        <i class="fas fa-star"></i>
        Review
       </a>
       </li>

      <li class="nav-item">
       <a class="nav-link <?php if(PAGE == 'Requesterchangepass') { echo 'active'; } ?>" href="Requesterchangepass.php">
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