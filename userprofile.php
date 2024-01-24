<?php

  // session_start(); 
  require_once("./config/db.php"); //the keeps the file and also doesnt show the page if path is wrong
  require_once("./config/function.php");

  $userdata = check_login($db);

?> 


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard | By Code Info</title>
  <link rel="stylesheet" href="./css/userprofile.css" />
  <link rel="stylesheet" href="./css/all.min.css">
  <!-- Font Awesome Cdn Link -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" /> -->
</head>
<body>
  <header class="header">
    <!-- <div class="header-icons">
      <i class="fas fa-bell"></i> -->
      <div class="brand-details">
            <img src="./images/logo.png" alt="site logo " width="90px"  >
      </div>
      <div class="brand-title">
            <h2 class="page-title">Profile Details</h2>
        </div>
  </header>

  <div class="container">
    <nav class="nav-bar" >
        <ul class="nav-wrap">
          <li style="background: #202020; padding-top: 10px;"><a class="nav-icon" href="index.php"><i style="background: #202020;" class="fas fa-home "></i> Home </a></li>
          <li  style="background: #202020; padding-top: 20px;"><a href="" class="nav-icon"><i style="background: #202020;"class="fas fa-user "></i> Profile</a></li>
          <li  style="background: #202020; padding-top: 20px;"><a href="" class="nav-icon"><i style="background: #202020;" class="fas fa-cog"></i> Settings</a></li>
          <li  style="background: #202020; padding-top: 20px;"><a href="" class="nav-icon"><i style="background: #202020;"class="fas fa-question-circle "></i> Help</a></li>
          <li style="background: #202020; "><a href="./logout.php" class="logout nav-icon"><i style="background: #202020;"class="fas fa-sign-out-alt "></i> Log out</a></li>
        </ul>
      </nav>
  

    <div class="main-body">
      <div class="promo_card">
        <h1 class="welcome-message">Welcome to Your Dashboard <?php echo $userdata['username']; ?></h1>
        <span style="background-color: #202020;" class="card-info">Healthy Food delivery for you.</span>
        <!-- <button>Learn More</button> -->
      </div>

      <div class="profile-container">
        <div class="profile-info">
          <p class="bold-text">User-Name<span style="text-align: center;" class="info-text"><?php echo $userdata['username']; ?></span></p> 
          <p class="bold-text">First Name<span class="info-text"> <?php echo $userdata['firstname']; ?></span></p> 
          <p class="bold-text">Last Name<span class="info-text"><?php echo $userdata['lastname']; ?></span></p> 
          <p class="bold-text">Email<span class="info-text"><?php echo $userdata['email']; ?></span></p> 
          <p class="bold-text">Phone Number<span class="info-text"><?php echo $userdata['phone']; ?></span></p> 
          <p class="bold-text">Gender<span class="info-text"><?php echo $userdata['gender']; ?></span></p> 
          <p class="bold-text">Date of Birth<span class="info-text"><?php echo $userdata['dob']; ?></span></p> 
          <p class="bold-text">Health Challenge<span class="info-text"><?php echo $userdata['healthchallenges']; ?></span></p> 
          <p class="bold-text">Delivery Address<span class="info-text"><?php echo $userdata['address']; ?></span></p> 
        </div>
        <button class="edit-button">Edit Profile</button>
      </div>

      <!-- <div class="history_lists">
        <div class="list1">
          <div class="row">
            <h4 style="color: #202020;">Order History</h4>
            <a href="#" class="view-more">See all</a>
          </div>
          <table>
            <thead>
              <tr>
                <th>#</th>
                <th>Dates</th>
                <th>Time</th>
                <th>Food Ordered</th>
                <th>Category</th>
                <th>Amount</th>
                <th>Delivery Address</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>2, Aug, 2022</td>
                <td>Sam Tonny</td>
                <td>Premimum</td>
                <td>$2000.00</td>
              </tr>
              <tr>
                <td>2</td>
                <td>29, July, 2022</td>
                <td>Code Info</td>
                <td>Silver</td>
                <td>$5,000.00</td>
              </tr>
              <tr>
                <td>3</td>
                <td>15, July, 2022</td>
                <td>Jhon David</td>
                <td>Startup</td>
                <td>$3000.00</td>
              </tr>
              <tr>
                <td>4</td>
                <td>5, July, 2022</td>
                <td>Salina Gomiz</td>
                <td>Premimum</td>
                <td>$7000.00</td>
              </tr>
              <tr>
                <td>5</td>
                <td>29, June, 2022</td>
                <td>Gomiz</td>
                <td>Gold</td>
                <td>$4000.00</td>
              </tr>
              <tr>
                <td>6</td>
                <td>28, June, 2022</td>
                <td>Elyana Jhon</td>
                <td>Premimum</td>
                <td>$2000.00</td>
              </tr>
            </tbody>
          </table>
        </div> -->

        
      </div>
    </div>
  </div>

  <footer class="base-footer">
    <div class="footer-details">
        <img src="./images/logo.png" alt="site logo " width="90px" style="background-color: #FC8019; display: flex;
        justify-content: left; margin: 40px 0px 40px 60px; " >
    </div>

    <nav style="background-color: #FC8019; margin-top: 17px;" class="footer-bar"> 
        <ul  class="footer-wrap">
            <a href="./"  class="footer-link">About us</a>
            <a href="./" class="footer-link">Delivery</a>
            <a href="./" class="footer-link">Help & Support</a>
            <a href="./" class="footer-link">T&C</a>
            
        </ul>
    </nav>
    <div  class="footer-extra">
        <a href="#" id="Twitter" class="fab fa-twitter footer-link"></a>
        <a href="#" id="Facebook" class="fab fa-facebook footer-link"></a>
        <a href="#" id="Instagram" class="fab fa-instagram footer-link"></a>
       
    </div>
    
</footer>


  <script src="./js/script.js"></script>
  <script src="./js/all.min.js"></script>
</body>
</html>
