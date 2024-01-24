<?php

  // session_start(); 
  require_once("./config/db.php"); //the keeps the file and also doesnt show the page if path is wrong
  require_once("./config/function.php");

  $userdata = check_login($db);

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
                <li><a href="./contact.php" class="nav-link">Contact</a></li>
                <li><a href="./blog" class="nav-link">Blogs</a></li>
            </ul>
        </nav>
        <div class="top-extra2">
        <?php

            if (isset($_SESSION['user_id'])) {
                // User is logged in
                echo '<a href="./userprofile.php" class="nav-link"><i class="fa fa-user"></i></a>';
                echo '<a href="./order.php" class="nav-link"><i class="fas fa-utensils"></i></a>';
                echo '<span class="nav-icon nav-cart"><a href="shopping-cart.php"><i class="fa fa-shopping-bag"></i> <p class="cart-label">0</p></a></span>';
            } 
        ?>
        </div>
        <?php 
            if (!isset($_SESSION['user_id'])) {
                // User is not logged in
                echo '<div class="top-extra">';
                echo '<a href="./userprofile.php" class="nav-link"><i class="fa fa-user"></i></a>';
                echo '<a href="./order.php" class="nav-link"><i class="fas fa-utensils"></i></a>';
                echo '<span class="nav-icon nav-cart"><a href="shopping-cart.php"><i class="fa fa-shopping-bag"></i> <p class="cart-label">0</p></a></span>';
                echo '</div>';
                echo '<span style="padding-top:15px; "><a href="./signup.php" nav-log" class="nav-sign">Signup</a></span>';
                echo '<span style="padding-top: 15px;"><a href="./login.php" class="nav-sign">Login</a></span>';
            }
        ?>
            <!-- <span class="nav-toggle"><i class="fa fa-bars"></i></span> -->
       
    </header>
    
    <main class="main-body"> 
        <!--CATEGORY SECTION -->
        <section class="dish-section">
            <div class="section-heading">
                <h4 style=" font-weight: bolder; font-size: 20px; color: #202020; " class="section-title">Category of Food</h4>
            </div>
            <div class="menu-wrap">
                 <?php
            // Fetch dish data from the "categorys" table in the database
            $query = "SELECT * FROM categorys";
            $result = mysqli_query($db, $query);

           
        // Check if any categories are found
        if (mysqli_num_rows($result) > 0) {
            // Loop through the fetched results and generate HTML code for each category
            while ($category = mysqli_fetch_assoc($result)) {
                $image = $category['image'];
                $title = $category['category_title'];
                $description = $category['category_desc'];
                $filename = strtolower(str_replace(" ", "-", $title)) . ".php";
                ?>
                <aside class="menu-card">
                    <img src="./images/category/<?php echo $image; ?>" alt="" class="dish-image">
                    <div class="dish-info">
                        <h3 class="menu-title"><?php echo $title; ?></h3>
                        <p class="dish-desc"><?php echo $description; ?></p>
                        <a href="./<?php echo $filename; ?>" class="category-button">View Category</a>
                    </div>
                </aside>
            <?php
             }
                } else {
            // No dishes found
            echo "No Categorys found.";
            }
            ?>
            </div>
        </section>


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