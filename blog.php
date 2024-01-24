<?php
// session_start();
require_once("./config/db.php");
include("./config/function.php");



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> </title>
    <link rel="stylesheet" href="./css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/linearicons-v1.0.0/icon-font.min.css">
    <script src="./js/all.min.js"></script>
    
</head>
<body>
    <header class="top-header">
        <!-- <a href="./" class="brand-details">
            <i class="fa fa-cutlery"></i>
            <h1 class="brand-name">FoodiHub</h1>
        </a> -->
        <div class="brand-details">
            <img src="./images/logo.png" alt="site logo " width="90px"  >
            
        </div>

        <nav class="nav-bar2"> 
            <ul class="nav-wrap">
                <li><a href="./index.php" class="nav-link">Home</a></li>
                <li><a href="./menu.php" class="nav-link">Menu</a></li>
                <li><a href="./contact" class="nav-link">Contact</a></li>
                <li><a href="./blog.php" class="nav-link">Blogs</a></li>
            </ul>
        </nav>
        <div class="top-extra2">
        <?php

            if (isset($_SESSION['user_id'])) {
                // User is logged in
                echo '<a href="./userprofile.php" class="nav-link"><i class="fa fa-user"></i></a>';
                echo '<a href="./order.php" class="nav-link"><i class="fas fa-utensils"></i></a>';
                echo '<span class="nav-icon nav-cart"><a href="shopping-cart.php"><i class="fa fa-shopping-bag"></i> <p id="cart-label" class="cart-label">0</p></a></span>';
            } 
            ?>
        </div>
        <?php 
         if (!isset($_SESSION['user_id'])) {
                // User is not logged in
                echo '<div class="top-extra">';
                echo '<a href="./userprofile.php" class="nav-link"><i class="fa fa-user"></i></a>';
                echo '<a href="./order.php" class="nav-link"><i class="fas fa-utensils"></i></a>';
                echo '<span class="nav-icon nav-cart"><a href="shopping-cart.php"><i class="fa fa-shopping-bag"></i> <p id="cart-label" class="cart-label">0</p></a></span>';
                echo '</div>';
                echo '<span style="padding-top:15px; "><a href="./signup.php" nav-log" class="nav-sign">Signup</a></span>';
                echo '<span style="padding-top: 15px;"><a href="./login.php" class="nav-sign">Login</a></span>';
            }
            ?>
            <!-- <span class="nav-toggle"><i class="fa fa-bars"></i></span> -->
       
    </header>

    <!--==Blog================================-->
    <section id="blog">

        <div class="blog-heading">
            <h3>Our Blog</h3>
        </div>

        <!--**container**************-->
        <div class="blog-box-container">
        
            <!-- **box** -->
            <div class="blog-box">
                <!--img-->
                <div class="blog-box-img">
                    <img src="./images/foodallegy.jpg" alt="blog">
                    <a href="#" class="blog-img-link">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </a>
                </div>
                <!--text-->
                <div class="blog-box-text">
                    <strong>Food Allergy</strong>
                    <a href="#">Understanding Food Allergies and Intolerances</a>
                    <p>Educate readers about different food allergies and intolerances, their symptoms, diagnosis, and how to navigate them when ordering food online.</p>
                    <div class="blog-author">
                        <div class="blog-author-img">
                            <img src="images/b2.jpg" alt="">
                        </div>
                        <div class="blog-author-text">
                            <strong>.I.Clinton</strong>
                            <span>July 12, 2023</span>
                        </div>
                    </div>
                </div>
            </div><!--box-end-->

            <!-- **box** -->
            <div class="blog-box">
                <!--img-->
                <div class="blog-box-img">
                    <img src="images/food.jpg" alt="blog">
                    <a href="#" class="blog-img-link">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </a>
                </div>
                <!--text-->
                <div class="blog-box-text">
                    <strong>Healthy Food</strong>
                    <a href="#">Smart Food Substitutions for Healthier Options</a>
                    <p>Suggest healthier alternatives and ingredient substitutions for commonly used ingredients to make meals more nutritious and suitable for individuals with health challenges.</p>
                    <div class="blog-author">
                        <div class="blog-author-img">
                            <img src="images/b3.jpg" alt="">
                        </div>
                        <div class="blog-author-text">
                            <strong>.I.Clinton</strong>
                            <span>June 12, 2023</span>
                        </div>
                    </div>
                </div>
            </div><!--box-end-->


            <!-- **box** -->
            <div class="blog-box">
                <!--img-->
                <div class="blog-box-img">
                    <img src="images/budget.jpg" alt="blog">
                    <a href="#" class="blog-img-link">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </a>
                </div>
                <!--text-->
                <div class="blog-box-text">
                    <strong>Food Finance</strong>
                    <a href="#">Eating Well on a Budget with Health Challenges</a>
                    <p> Share budget-friendly meal planning strategies, affordable ingredient options, and money-saving tips for individuals with health challenges.</p>
                    <div class="blog-author">
                        <div class="blog-author-img">
                            <img src="images/b1.jpg" alt="">
                        </div>
                        <div class="blog-author-text">
                            <strong>Alax</strong>
                            <span>Jan 12, 2023</span>
                        </div>
                    </div>
                </div>
            </div><!--box-end-->

            <!-- **box** -->
            <div class="blog-box">
                <!--img-->
                <div class="blog-box-img">
                    <img src="images/well2.jpg" alt="blog">
                    <a href="#" class="blog-img-link">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </a>
                </div>
                <!--text-->
                <div class="blog-box-text">
                    <strong>Humans Well Being</strong>
                    <a href="#">Exercise and Nutrition for Overall Well-being</a>
                    <p>Emphasize the connection between physical activity, healthy eating, and overall well-being, and provide tips on how to incorporate exercise and nutrition into a balanced lifestyle.</p>
                    <div class="blog-author">
                        <div class="blog-author-img">
                            <img src="images/b1.jpg" alt="">
                        </div>
                        <div class="blog-author-text">
                            <strong>Alax</strong>
                            <span>Jan 12, 2023</span>
                        </div>
                    </div>
                </div>
            </div><!--box-end-->
        
            <!-- **box** -->
            <div class="blog-box">
                <!--img-->
                <div class="blog-box-img">
                    <img src="images/organic.jpg" alt="blog">
                    <a href="#" class="blog-img-link">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </a>
                </div>
                <!--text-->
                <div class="blog-box-text">
                    <strong>Organic</strong>
                    <a href="#">Benefits of Locally Sourced and Organic Foods</a>
                    <p> Highlight the advantages of choosing locally sourced and organic foods, including their potential benefits for health and the environment.</p>
                    <div class="blog-author">
                        <div class="blog-author-img">
                            <img src="images/b1.jpg" alt="">
                        </div>
                        <div class="blog-author-text">
                            <strong>Alax</strong>
                            <span>Jan 12, 2023</span>
                        </div>
                    </div>
                </div>
            </div><!--box-end-->
        
            
        </div>
    
    </section>

</body>
</html>
  