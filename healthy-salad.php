<?php
// session_start();
require_once("./config/db.php");
include("./config/function.php");

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

        <nav class="nav-bar"> 
            <ul class="nav-wrap">
                <li><a href="./index.php" class="nav-link">Home</a></li>
                <li><a href="./menu.php" class="nav-link">Menu</a></li>
                <li><a href="./contact" class="nav-link">Contact</a></li>
                <li><a href="./blog" class="nav-link">Blogs</a></li>
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
                echo '<span class="nav-icon nav-cart"><a href="shopping-cart.php"><i class="fa fa-shopping-bag"></i> <p id="cart-label" class="cart-label">0</p></a></span>';
                echo '</div>';
                echo '<span style="padding-top:15px; "><a href="./signup.php" nav-log" class="nav-sign">Signup</a></span>';
                echo '<span style="padding-top: 15px;"><a href="./login.php" class="nav-sign">Login</a></span>';
            }
            ?>
            <!-- <span class="nav-toggle"><i class="fa fa-bars"></i></span> -->
       
    </header>
    
    <main class="main-body">
        
        <!--HEALTHY SALAD SECTION -->
        <section class="dish-section">
            <div class="section-heading">
                <h4 class="section-title">Healthy Salad Category </h4>
            </div>
            <div class="dish-wrap">
            <?php
            // Fetch dish data from the "healthy_salad" table in the database
            $query = "SELECT * FROM salads";
            $result = mysqli_query($db, $query);

            // Check if any dishes are found
            if (mysqli_num_rows($result) > 0) {
            // Loop through the fetched results and generate HTML code for each dish
            while ($salad = mysqli_fetch_assoc($result)) {
                $image = $salad['image'];
                $category = $salad['salad_category'];
                $title = $salad['salad_title'];
                $portion = $salad['salad_portion'];
                $price = $salad['salad_price'];
                $time = $salad['salad_time'];
                $description = $salad['salad_desc'];
            ?>
                <aside class="dish-card">
                    <img src="./images/category/healthysalad/<?php echo $image; ?>" alt="" class="dish-image">
                     <div class="dish-info">
                         <div class="dish-label">
                            <span><b class="category-dish">Category <i class="fa fa-chevron-right"></i> <?php echo $category; ?></b></span>
                        </div>
                        <h3 class="dish-title"><?php echo $title; ?></h3>
                           
                            <div class="portion-section">
                                <label for="food-portion" class="portion-title">Portion</label>
                                <select id="portion" name="salad_portion" class="portion-area">
                                    <option value="" selected disabled>Select Portion</option>
                                    <option value="Small" <?php if ($portion === 'Small') echo 'selected'; ?>>Small</option>
                                    <option value="Medium" <?php if ($portion === 'Medium') echo 'selected'; ?>>Medium</option>
                                    <option value="Large" <?php if ($portion === 'Large') echo 'selected'; ?>>Large</option>
                                </select>
                            </div>

                        <h4 class="dish-price"> <img class="dish-svg" src="./images/components/Vector.svg" alt=""> &nbsp;&#8358;<?php echo $price; ?> </h4>
                        <h4 class="dish-time"> <img class="dish-svg" src="./images/components/Group.svg" alt=""> <?php echo $time; ?></h4>
                       
                        <form action="./shopping-cart.php"  id="addToCartForm_<?php echo $salad['salad_id']; ?>" method="POST">
                            <button type="submit" name="add_to_cart" class="add-cart" onclick="addToCart(<?php echo $salad['salad_id']; ?>)"  >Add to Cart</button>
                            <input type="hidden" name="dish_id" value="<?php echo $salad['salad_id']; ?>">
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
            echo "No Food found.";
        } ?>
         <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart']) && isset($_POST['dish_id']) && $_POST['dish_id'] == $dish['salad_id']): ?>
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
                    document.getElementById("addToCartForm_<?php echo $dish['salad_id']; ?>").reset();
                    </script>
            </div>
        </section>
            </div>
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