<?php
    require_once("../config/db.php")
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/all.min.css">

    <title>Admin Home</title>
</head>
<body>
<header class="top-header">
        <!-- <a href="./" class="brand-details">
            <i class="fa fa-cutlery"></i>
            <h1 class="brand-name">FoodiHub</h1>
        </a> -->
        <div class="brand-details">
            <img src="../images/logo.png" alt="site logo " width="90px"  >
            
        </div>

        <nav class="nav-bar2"> 
            <ul class="nav-wrap">
                <li><a href="./homeadmin.php" class="nav-link">Home</a></li>
                <li><a href="./index.php" class="nav-link">Users</a></li>
                <li><a href="../menus/menuindex.php" class="nav-link">Menu</a></li>
                <li><a href="../menucategory/categoryindex.php" class="nav-link">Category</a></li>
                <li><a href="../orders/orderindex" class="nav-link">Orders</a></li>
                <li><a href="./order" class="nav-link">Contact</a></li>
                <li><a href="./order" class="nav-link">Blogs</a></li>
            </ul>
        </nav>
        <div class="top-extra2">
            <a href="./userprofile.php" class="nav-link"><i class="fa fa-user"></i></a>
            
           
            
        </div>

           
            <span><a href="./login.php" class="nav-sign2">Login</a></span> 
  
            <!-- </div> -->
            <!-- <span class="nav-toggle"><i class="fa fa-bars"></i></span> -->
       
    </header>
    
  
    <div style="margin-top: 70px; margin-left: 50px;" class="">

        <div class="row">
            <div class="">
                <div style="margin-top: 40px;">
                <h4  style="margin-top: 40px; margin-bottom: 30px; font-weight: bolder; ">Admin Home
                            <!-- <a href="student-create.php" class="btn btn-primary float-end">Add Students</a> -->
                        </h4>
                    <div style="margin-top: 40px;">
                           <!-- ABOUT SECTION -->
                        <div class="admin-section">
                            <h2 class="admin-head"></h2>
                            <section class="section-info">
                                <div class="admin-card admin-one">
                                    <div class="admin-icon">
                                        <img src="../images/components/totalorders.jpg" class="admin-image" alt="">
                                    </div>
                                    <div class="admin-info">
                                        <h3 class="admin-title">Total Orders</h3>
                                        <h4 class="admin-sub" >45</h4>
                                    </div>
                                </div>
                                
                                <div class="admin-card admin-two">
                                    <div class="admin-icon">
                                        <img src="../images/components/completeorders.jpg" class="admin-image" alt="">
                                    </div>
                                    <div class="admin-info">
                                        <h3 class="admin-title">Completed Orders</h3>
                                        <h4 class="admin-sub" >35</h4>
                                    </div>
                                </div>
                                
                                <div class="admin-card admin-two">
                                    <div class="admin-icon">
                                        <img src="../images/components/pendingorders.jpg" class="admin-image" alt="">
                                    </div>
                                    <div class="admin-info">
                                        <h3 class="admin-title">Pending Orders</h3>
                                        <h4 class="admin-sub" >10</h4>
                                    </div>
                                </div>

                                <div class="admin-card admin-two">
                                    <div class="admin-icon">
                                        <img src="../images/components/meal.jpg" class="admin-image" alt="">
                                    </div>
                                    <div class="admin-info">
                                        <h3 class="admin-title">Popular Meal Orders</h3>
                                        <h4 class="admin-sub" >Low Carbs Meal</h4>
                                    </div>
                                </div>
                            </section>
                        </div>





           <!-- admin SECTION -->
           <!-- <div class="about-section">
            <h2 class="about-head">  <img src="./images/components/Ellipse 9.svg" id="eclipse-svg" alt="ecplise"> How to place an ORDER</h2>
            <section class="section-info">
                <div class="about-card about-one">
                    <div class="about-icon">
                        <img src="./images/components/user (1) 1.png" class="about-image" alt="">
                    </div>
                    <div class="about-info">
                        <h3 class="about-title">1. Create Account</h3>
                        <p class="about-subtitle">First of alll you have to Create an Account and then Log in into your profile </p>
                    </div>
                </div>

                <div class="about-card about-two">
                    <div class="about-icon">
                        <img src="./images/components/restaurant (1) 1.png" class="about-image" alt="">
                    </div>
                    <div class="about-info">
                        <h3 class="about-title">2. Order Food</h3>
                        <p class="about-subtitle">Select the food of your choice from any category of food and Order to finish up </p>
                    </div>
                </div>

                <div class="about-card about-three">
                    <div class="about-icon">
                        <img src="./images/components/map 1.png" class="about-image" alt="">
                    </div>
                    <div class="about-info">
                        <h3 class="about-title">3. Enter Location of Delivery</h3>
                        <p class="about-subtitle">Make sure to enter you current location where u want you food to be delivered too</p>
                    </div>
                </div>

                <div class="about-card about-four">
                    <div class="about-icon">
                        <img src="./images/components/cash-payment 1.png" class="about-image" alt="">
                    </div>
                    <div class="about-info">
                        <h3 class="about-title">4. Make Payment</h3>
                        <p class="about-subtitle">you will be rquired to make. Done Volia! You food is own its way to be delivered</p>
                    </div>
                </div>
            </section>
        </div>



                    </div>
                    <div class="card-body">

       
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- <footer class="base-footer">
        <div class="footer-details">
            <img src="../images/logo.png" alt="site logo " width="90px" style="background-color: #FC8019; display: flex;
            justify-content: left; margin: 40px 0px 40px 60px; " >
        </div>

        <nav class="footer-bar"> 
            <ul class="footer-wrap">
                <a href="./" class="footer-link">About us</a>
                <a href="./" class="footer-link">Delivery</a>
                <a href="./" class="footer-link">Help & Support</a>
                <a href="./" class="footer-link">T&C</a>
                
            </ul>
        </nav>
        <div class="footer-extra">
            <a href="#" id="Twitter"  class="fab fa-twitter footer-link"></a>
            <a href="#" id="Facebook" class="fab fa-facebook footer-link"></a>
            <a href="#" id="Instagram" class="fab fa-instagram footer-link"></a>
           
        </div>
        
    </footer> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/all.min.js"></script>

</body>
</html>