<?php
// session_start();
require_once("./config/db.php");
include("./config/function.php");

$userdata = check_login($db);

// Retrieve user's dietary preference from the database
$user_id = $_SESSION['user_id'];
$query = "SELECT healthchallenges FROM users WHERE user_id = $user_id";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_assoc($result);
$dietary_preference = $row['healthchallenges'];

// Check if the user has celiac disease
$has_celiac_disease = $dietary_preference === 'Celiac disease';

// Query the database for random gluten-free and health salads based on dietary preference
$glutenQuery = "SELECT * FROM glutens ORDER BY RAND() LIMIT 2";
$glutenResult = mysqli_query($db, $glutenQuery);

$saladQuery = "SELECT * FROM salads ORDER BY RAND() LIMIT 2";
$saladResult = mysqli_query($db, $saladQuery);


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
        <div class="brand-details">
            <img src="./images/logo.png" alt="site logo " width="90px">
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
    </header>
    
    <main class="main-body">
        <?php if ($has_celiac_disease): ?>
            <section class="section-slide">
                <div class="search-container">
                    <input type="search" class="search-bar" placeholder="Dishes and delicacies of your choice">
                    <button type="submit" class="search-button">Search</button>
                </div>
            </section>
        
            <!-- Personalized SECTION -->
            <section class="dish-section">
                <div class="section-heading">
                    <h4 class="section-title">Personalized Dishes</h4>
                </div>
                <div class="dish-wrap">
                    <?php while ($gluten = mysqli_fetch_assoc($glutenResult)): ?>
                        <aside class="dish-card">
                            <img src="./images/category/gluten/<?php echo $gluten['image']; ?>" alt="" class="dish-image">
                            <div class="dish-info">
                                <div class="dish-label">
                                    <span><b class="category-dish">Category <i class="fa fa-chevron-right"></i> <?php echo $gluten['gluten_category']; ?></b></span>
                                </div>
                                <h3 class="dish-title"><?php echo $gluten['gluten_title']; ?></h3>
                                <div class="dish-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-stroke"></i>
                                    <i class="far fa-star"></i>
                                    <span class="rating-total">56</span>
                                </div>

                                <div class="portion-section">
                                    <label for="food-portion" class="portion-title">Portion</label>
                                    <select id="portion" name="dish_portion" class="portion-area">
                                        <option value="" selected disabled>Select Portion</option>
                                        <option value="Small" <?php if ($gluten['gluten_portion'] === 'Small') echo 'selected'; ?>>Small</option>
                                        <option value="Medium" <?php if ($gluten['gluten_portion'] === 'Medium') echo 'selected'; ?>>Medium</option>
                                        <option value="Large" <?php if ($gluten['gluten_portion'] === 'Large') echo 'selected'; ?>>Large</option>
                                    </select>
                                </div>

                                <h4 class="dish-price"><img class="dish-svg" src="./images/components/Vector.svg" alt="">&nbsp;&#8358;<?php echo $gluten['gluten_price']; ?></h4>
                                <h4 class="dish-time"><img class="dish-svg" src="./images/components/Group.svg" alt=""> <?php echo $gluten['gluten_time']; ?></h4>

                                <form action="shopping-cart.php" id="addToCartForm_<?php echo $gluten['gluten_id']; ?>" method="POST">
                                    <button type="submit" name="add_to_cart" class="add-cart" onclick="addToCart(<?php echo $gluten['gluten_id']; ?>)">Add to Cart</button>
                                    <input type="hidden" name="dish_id" value="<?php echo $gluten['gluten_id']; ?>">
                                    <input type="hidden" name="dish_image" value="<?php echo $gluten['image']; ?>">
                                    <input type="hidden" name="dish_category" value="<?php echo $gluten['gluten_category']; ?>">
                                    <input type="hidden" name="dish_portion" value="<?php echo $gluten['gluten_portion'] !== '' ? $gluten['gluten_portion'] : 'Medium'; ?>">
                                    <input type="hidden" name="dish_title" value="<?php echo $gluten['gluten_title']; ?>">
                                    <input type="hidden" name="dish_price" value="<?php echo $gluten['gluten_price']; ?>">
                                </form>

                                <p class="dish-desc"><?php echo $gluten['gluten_desc']; ?></p>
                            </div>
                        </aside>
                    <?php endwhile; ?>

                    <?php while ($salad = mysqli_fetch_assoc($saladResult)): ?>
                        <aside class="dish-card">
                            <img src="./images/category/healthysalad/<?php echo $salad['image']; ?>" alt="" class="dish-image">
                            <div class="dish-info">
                                <div class="dish-label">
                                    <span><b class="category-dish">Category <i class="fa fa-chevron-right"></i> <?php echo $salad['salad_category']; ?></b></span>
                                </div>
                                <h3 class="dish-title"><?php echo $salad['salad_title']; ?></h3>
                                <div class="dish-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-stroke"></i>
                                    <i class="far fa-star"></i>
                                    <span class="rating-total">56</span>
                                </div>

                                <div class="portion-section">
                                    <label for="food-portion" class="portion-title">Portion</label>
                                    <select id="portion" name="dish_portion" class="portion-area">
                                        <option value="" selected disabled>Select Portion</option>
                                        <option value="Small" <?php if ($salad['salad_portion'] === 'Small') echo 'selected'; ?>>Small</option>
                                        <option value="Medium" <?php if ($salad['salad_portion'] === 'Medium') echo 'selected'; ?>>Medium</option>
                                        <option value="Large" <?php if ($salad['salad_portion'] === 'Large') echo 'selected'; ?>>Large</option>
                                    </select>
                                </div>

                                <h4 class="dish-price"><img class="dish-svg" src="./images/components/Vector.svg" alt="">&nbsp;&#8358;<?php echo $salad['salad_price']; ?></h4>
                                <h4 class="dish-time"><img class="dish-svg" src="./images/components/Group.svg" alt=""> <?php echo $salad['salad_time']; ?></h4>

                                <form action="shopping-cart.php" id="addToCartForm_<?php echo $salad['salad_id']; ?>" method="POST">
                                    <button type="submit" name="add_to_cart" class="add-cart" onclick="addToCart(<?php echo $salad['salad_id']; ?>)">Add to Cart</button>
                                    <input type="hidden" name="dish_id" value="<?php echo $salad['salad_id']; ?>">
                                    <input type="hidden" name="dish_image" value="<?php echo $salad['image']; ?>">
                                    <input type="hidden" name="dish_category" value="<?php echo $salad['salad_category']; ?>">
                                    <input type="hidden" name="dish_portion" value="<?php echo $salad['salad_portion'] !== '' ? $salad['salad_portion'] : 'Medium'; ?>">
                                    <input type="hidden" name="dish_title" value="<?php echo $salad['salad_title']; ?>">
                                    <input type="hidden" name="dish_price" value="<?php echo $salad['salad_price']; ?>">
                                </form>

                                <p class="dish-desc"><?php echo $salad['salad_desc']; ?></p>
                            </div>
                        </aside>
                    <?php endwhile; ?>
                </div>
            </section>
        <?php endif; ?>
    </main>


    <footer class="base-footer">
        <div class="footer-details">
            <img src="./images/logo.png" alt="site logo " width="90px" style="background-color: #FC8019; display: flex;
            justify-content: left; margin: 40px 0px 40px 60px;">
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


    <script src="./js/script.js"></script>
    <script src="./js/bootstrap.min.js"></script>

</body>
</html>
