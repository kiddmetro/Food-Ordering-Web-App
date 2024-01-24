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
    <link rel="stylesheet" href="./css/bootstrap.min.css" >
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
                <li><a href="./blog" class="nav-link">Blogs</a></li>
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
    
    <main class="main-body">
       <section class="category-section" id="contactWrap">
        <form  method="POST" id="contactForm" class="category-card">
            
        <input type="hidden" name="contactTrigger">
          <figure class="category-icon"><i style="background-color: #FC8019; " class="fa fa-envelope"></i></figure>
            <h3 class="category-title">We are here to take your enquiries</h3>
            
            <label for="firstname" class="category-text">First Name</label>
            <input type="text" name="firstname" required id="firstname" class="form-control">
            
            <label for="lastname" class="category-text">Last Name</label>
            <input type="text" name="lastname" required id="lastname" class="form-control">

            <label for="email" class="category-text">Email</label>
            <input type="email" name="email" required id="email" class="form-control">

            <label for="message" class="category-text">Message</label>
            <textarea name="message" required id="message" class="form-control" placeholder="please enter your message here" rows="5"></textarea>
            
            
            <button type="submit" class="cta message-btn" name="message_btn">Send Message</button>
        </form>
    </section>
    
    </main>

    <footer class="base-footer">
        <div class="footer-details">
            <img src="./images/logo.png" alt="site logo " width="90px" style="background-color: #FC8019; display: flex;
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
        
    </footer>

    <!-- ********************************************* ORDERING FOOD ****************************************8 -->
      <!-- Overlay -->
      <!-- <div id="overlay" class="overlay"></div>
      Popup
       <div id="popup" class="popup">
       <div id="popup-content"></div>
              <h2>Confirmation</h2>
              <p>Are you sure you want to add this item to your cart?</p>
              <button onclick="addToCart()" class="add-cart">Yes, Add to Cart</button>
              <button class="cancel-cart" onclick="closePopup()">No, Cancel</button>
      </div> -->

    <script src="./js/script.js"></script>
    <script src="./js/bootstrap.min.js"></script>

</body>

</html>