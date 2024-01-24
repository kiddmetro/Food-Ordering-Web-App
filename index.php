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

    <!-- HEADER/NAVBAR -->
    <header class="top-header">
        <!-- <a href="./" class="brand-details">
            <i class="fa fa-cutlery"></i>
            <h1 class="brand-name">FoodiHub</h1>
        </a> -->
        <div class="brand-details">
            <img src="./images/logo.png" alt="site logo " width="90px"  >
            
        </div>

        <nav class="nav-bar"> 
            <ul class="nav-wrap">
                <li><a href="./index.php" class="nav-link">Home</a></li>
                <li><a href="./menu.php" class="nav-link">Menu</a></li>
                <li><a href="./contact" class="nav-link">Contact</a></li>
                <li><a href="./blog" class="nav-link">Blogs</a></li>
                <li><a href="./signup.php" class="nav-link-extra">Signup</a></li>
                <li ><a href="./login.php" class="nav-link-extra">Login</a></li>
            </ul>
        </nav>
        <div class="top-extra">
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
                echo '<span class="nav-icon nav-cart"><a href="shopping-cart.php"><i class="fa fa-shopping-bag shopping-icon"></i> <p id="cart-label" class="cart-label">0</p></a></span>';
                echo '</div>';
                echo '<span style="padding-top:15px; "><a href="./signup.php" nav-log" class="nav-sign">Signup</a></span>';
                echo '<span style="padding-top: 15px;"><a href="./login.php" class="nav-sign">Login</a></span>';
            }
        ?>
        <span class="nav-toggle"><i class="fa-solid fa-bars"></i></span>
       
    </header>
    
    <main class="main-body">
        <!-- INTRO SECTION -->
        <section class="section-slide">
           <div class="intro-section">
                <div class="slide-card">
                    <h2 class="slide-subtext">Premium <span class="subtext-color">quality</span></h2>
                    <h2 class="slide-subtext">Food for your <img id="image-group2" class="img-slide" src="./images/components/Group 2.svg" alt="banana"> <span class="subtext-color">Healthy</span></h2>
                    <h2 class="slide-subtext"><img id="image-group1" class="img-slide"  src="./images/components/Group 1.svg" alt="banana"><span class="subtext-color">& Daily Life</span></h2>

                    <div class="search-container">
                <input type="search" class="search-bar" placeholder="Dishes and delicacies of your choice">
                <button type="submit" class="search-button">Search
                 
                </button>
            </div>
                
                </div>
                <div id="slider-container">
                    <img src="./images/components/Rectangle 1.png" alt="Image 1">
                    <img src="./images/components/Rectangle 2.png" alt="Image 2">
                    
                </div>
           </div>
        </section>
        
        <!--FEATURED DISHES SECTION -->
        <section class="dish-section">
            <div class="section-heading">
                <h4 class="section-title">Featured Dishes</h4>
            </div>
            <div class="dish-wrap">
            <?php
            // Fetch dish data from the "menus" table in the database
            $query = "SELECT * FROM menus";
            $result = mysqli_query($db, $query);

            // Check if any dishes are found
            if (mysqli_num_rows($result) > 0) {
            // Loop through the fetched results and generate HTML code for each dish
            while ($dish = mysqli_fetch_assoc($result)) {
                $image = $dish['image'];
                $category = $dish['dish_category'];
                $title = $dish['dish_title'];
                $portion = $dish['dish_portion'];
                $price = $dish['dish_price'];
                $time = $dish['dish_time'];
                $description = $dish['dish_desc'];
            ?>
                <aside class="dish-card">
                    <img src="./images/foody salad/<?php echo $image; ?>" alt="" class="dish-image">
                     <div class="dish-info">
                         <div class="dish-label">
                            <span><b class="category-dish">Category <i class="fa fa-chevron-right"></i> <?php echo $category; ?></b></span>
                        </div>
                        <h3 class="dish-title"><?php echo $title; ?></h3>

                            <div class="portion-section">
                                <label for="food-portion" class="portion-title">Portion</label>
                                <select id="portion" name="dish_portion" class="portion-area">
                                    <option value="" selected disabled>Select Portion</option>
                                    <option value="Small" <?php if ($portion === 'Small') echo 'selected'; ?>>Small</option>
                                    <option value="Medium" <?php if ($portion === 'Medium') echo 'selected'; ?>>Medium</option>
                                    <option value="Large" <?php if ($portion === 'Large') echo 'selected'; ?>>Large</option>
                                </select>
                            </div>

                        <h4 class="dish-price"> <img class="dish-svg" src="./images/components/Vector.svg" alt=""> &nbsp;&#8358;<?php echo $price; ?> </h4>
                        <h4 class="dish-time"> <img class="dish-svg" src="./images/components/Group.svg" alt=""> <?php echo $time; ?></h4>
                       
                        <form action="shopping-cart.php"  id="addToCartForm_<?php echo $dish['menu_id']; ?>" method="POST">
                            <button type="submit" name="add_to_cart" class="add-cart" onclick="addToCart(<?php echo $dish['menu_id']; ?>)"  >Add to Cart</button>
                            <input type="hidden" name="dish_id" value="<?php echo $dish['menu_id']; ?>">
                            <input type="hidden" name="dish_image" value="<?php echo $image; ?>">
                            <input type="hidden" name="dish_category" value="<?php echo $category; ?>">
                            <input type="hidden" name="dish_portion" value="<?php echo $portion !== '' ? $portion : 'Medium'; ?>">
                            <input type="hidden" name="dish_title" value="<?php echo $title; ?>">
                            <input type="hidden" name="dish_price" value="<?php echo $price; ?>">

                        </form>

                        <p class="dish-desc"><?php echo $description; ?></p>

                    </div>
                </aside>
            <?php } ?>
        <?php } else {
            // No dishes found
            echo "No dishes found.";
        } ?>
         <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart']) && isset($_POST['dish_id']) && $_POST['dish_id'] == $dish['menu_id']): ?>
                        <div class="overlay">
                            <div class="modal-box">
                                <span><i style="font-size: 120px; color: green;" class="fas fa-check-circle" ></i></span>
                                <h3>Item added to cart!</h3>
                                <button  id="okButton">OK</button>
                            </div>
                        </div>
                    <?php endif; ?>
                    <script>
                     document.getElementById("okButton").addEventListener("click", function() {
                    var overlay = document.querySelector(".overlay");
                    overlay.style.display = "none";
                    window.location.href = "index.php";
    
                    });setTimeout(function() {
                    window.location.href = "shopping-cart.php";
                    }, 600000000000000); // 1 minute delay (60,000 milliseconds)
                     // Clear the form data
                    document.getElementById("addToCartForm_<?php echo $dish['menu_id']; ?>").reset();
                    </script>
            </div>
        </section>

<!-- POPULAR SECTION -->
<section class="dish-section">
            <div class="section-heading">
                <h4 class="section-title">Popular Dishes</h4>
            </div>
            <div class="dish-wrap">
            <?php
            // Fetch dish data from the "menus" table in the database
            $query = "SELECT * FROM populars";
            $result = mysqli_query($db, $query);

            // Check if any dishes are found
            if (mysqli_num_rows($result) > 0) {
            // Loop through the fetched results and generate HTML code for each dish
            while ($dish = mysqli_fetch_assoc($result)) {
                $image = $dish['image'];
                $category = $dish['dish_category'];
                $title = $dish['dish_title'];
                $portion = $dish['dish_portion'];
                $price = $dish['dish_price'];
                $time = $dish['dish_time'];
                $description = $dish['dish_desc'];
            ?>
                <aside class="dish-card">
                    <img src="./images/popular/<?php echo $image; ?>" alt="" class="dish-image">
                     <div class="dish-info">
                         <div class="dish-label">
                            <span><b class="category-dish">Category <i class="fa fa-chevron-right"></i> <?php echo $category; ?></b></span>
                        </div>
                        <h3 class="dish-title"><?php echo $title; ?></h3>
    

                            <div class="portion-section">
                                <label for="food-portion" class="portion-title">Portion</label>
                                <select id="portion" name="dish_portion" class="portion-area">
                                    <option value="" selected disabled>Select Portion</option>
                                    <option value="Small" <?php if ($portion === 'Small') echo 'selected'; ?>>Small</option>
                                    <option value="Medium" <?php if ($portion === 'Medium') echo 'selected'; ?>>Medium</option>
                                    <option value="Large" <?php if ($portion === 'Large') echo 'selected'; ?>>Large</option>
                                </select>
                            </div>

                        <h4 class="dish-price"> <img class="dish-svg" src="./images/components/Vector.svg" alt=""> &nbsp;&#8358;<?php echo $price; ?> </h4>
                        <h4 class="dish-time"> <img class="dish-svg" src="./images/components/Group.svg" alt=""> <?php echo $time; ?></h4>
                       
                        <form action="shopping-cart.php"  id="addToCartForm_<?php echo $dish['popular_id']; ?>" method="POST">
                            <button type="submit" name="add_to_cart" class="add-cart" onclick="addToCart(<?php echo $dish['popular_id']; ?>)"  >Add to Cart</button>
                            <input type="hidden" name="dish_id" value="<?php echo $dish['popular_id']; ?>">
                            <input type="hidden" name="dish_image" value="<?php echo $image; ?>">
                            <input type="hidden" name="dish_category" value="<?php echo $category; ?>">
                            <input type="hidden" name="dish_portion" value="<?php echo $portion !== '' ? $portion : 'Medium'; ?>">
                            <input type="hidden" name="dish_title" value="<?php echo $title; ?>">
                            <input type="hidden" name="dish_price" value="<?php echo $price; ?>">

                        </form>

                        <p class="dish-desc"><?php echo $description; ?></p>

                    </div>
                </aside>
            <?php } ?>
        <?php } else {
            // No dishes found
            echo "No dishes found.";
        } ?>
         <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart']) && isset($_POST['dish_id']) && $_POST['dish_id'] == $dish['popular_id']): ?>
                        <div class="overlay">
                            <div class="modal-box">
                                <span><i style="font-size: 120px; color: green;" class="fas fa-check-circle" ></i></span>
                                <h3>Item added to cart!</h3>
                                <button  id="okButton">OK</button>
                            </div>
                        </div>
                    <?php endif; ?>
                    <script>
                     document.getElementById("okButton").addEventListener("click", function() {
                    var overlay = document.querySelector(".overlay");
                    overlay.style.display = "none";
                    window.location.href = "index.php";
    
                    });setTimeout(function() {
                    window.location.href = "shopping-cart.php";
                    }, 600000000000000); // 1 minute delay (60,000 milliseconds)
                     // Clear the form data
                    document.getElementById("addToCartForm_<?php echo $dish['popular_id']; ?>").reset();
                    </script>
            </div>
        </section>

        <!-- ABOUT SECTION -->
        <div class="about-section">
            <h2 class="about-head">  <img src="./images/components/Ellipse 9.svg" id="eclipse-svg" alt="ecplise"> How to place an ORDER</h2>
            <section style="background: rgb(255, 247, 239);"  class="section-info">
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

        <section class="section-transform">
            <div class="transform-truck">
                <i class="fa-solid fa-truck"></i> <img style="background-color: #FC8019; width: 150px;" src="./images/logo.png" alt="">
            </div>
        </section>
      
      <!-- SPECIAL SECTION -->
      <div class="special-section">
            <h2 class="special-head">  Customization and Personalized</h2>
            <section class="section-info">
                <div class="special-card special-one">
                    <div class="special-icon">
                        <img src="./images/customized.jpg" class="special-image" alt="">
                    </div>
                    <div class="special-info">
                        <h3 style=" background-color: #f0f0f0;"  class="special-title">Customize Your Food To Your Taste</h3>
                        <p style=" background-color: #f0f0f0;"  class="special-subtitle">First of alll you have to Create an Account and then Log in into your profile </p>
                        <a href=""  class="category-button">Customize Order</a>
                    </div>
                </div>

                <div class="special-card special-two">
                    <div class="special-icon">
                        <img src="./images/personalized.jpg" class="special-image" alt="">
                    </div>
                    <div style=" background-color: #f0f0f0;" class="special-info">
                        <h3 style=" background-color: #f0f0f0;"  class="special-title">Personalized Food Tailored for You</h3>
                        <p style=" background-color: #f0f0f0;"  class="special-subtitle">Select the food of your choice from any category of food and Order to finish up </p>
                        <a href="./personalized.php"  class="category-button">Personalized Recommendation</a>
                    </div>
                </div>

            </section>
        </div>

    
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