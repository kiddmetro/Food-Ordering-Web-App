<?php

  // session_start(); 
  require_once("./config/db.php"); //the keeps the file and also doesnt show the page if path is wrong
  require_once("./config/function.php");






  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['remove_from_cart'])) {
        $dishId = $_POST['dish_id'];
        if (isset($_SESSION['shopping-cart'])) {
            foreach ($_SESSION['shopping-cart'] as $index => $dish) {
                if ($dish['dish_id'] === $dishId) {
                    unset($_SESSION['shopping-cart'][$index]);
                    break;
                }
            }
        }
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['place_order'])) {
        // Check if the 'user_id' index is set in the $_SESSION array
        if (isset($_SESSION['user_id'])) {
            // Pass the cart items as URL parameters in the redirection URL
            $cartItems = json_encode($_SESSION['shopping-cart']);
            $redirectUrl = "payment.php?items=" . urlencode($cartItems);
            
            // Redirect to the payment page
            header("Location: $redirectUrl");
            exit();
        } else {
            // Redirect the user to the login page if they are not logged in
            header("Location: login.php");
            exit();
        }
    }
}








  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_to_cart'])) {
        $dishId = $_POST['dish_id'];
        $dishImage = $_POST['dish_image'];
        $dishCategory = $_POST['dish_category'];
        $dishPortion = $_POST['dish_portion'];
        $dishTitle = $_POST['dish_title'];
        $dishPrice = $_POST['dish_price'];

        // Create an array to store the dish details
        $dishDetails = [
            'dish_id' => $dishId,
            'dish_image' => $dishImage,
            'dish_category' => $dishCategory,
            'dish_portion' => $dishPortion,
            'dish_title' => $dishTitle,
            'dish_price' => $dishPrice,
        ];

        // Add the dish details to the shopping cart (e.g., store it in the $_SESSION)
        $_SESSION['shopping-cart'][] = $dishDetails;

        // Redirect to the shopping cart page or any other desired page
        header("Location: shopping-cart.php");
        exit();
    }
}



?>
 
 







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> </title>
    <link rel="stylesheet" href="./css/all.min.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css" >
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="fonts/iconic/css/material-design-iconic-font.min.css">
  	<link rel="stylesheet" href="fonts/linearicons-v1.0.0/icon-font.min.css">
    <script src="./js/all.min.js"></script>
    <script>
   function calculateTotal() {
            var total = 0;
            var quantityInputs = document.querySelectorAll('input[name="quantity"]');
            var priceElements = document.querySelectorAll('.dish-price');

            for (var i = 0; i < quantityInputs.length; i++) {
                var quantity = parseInt(quantityInputs[i].value);
                var price = parseFloat(priceElements[i].innerText.replace('₦', ''));

                total += quantity * price;
            }

            document.getElementById('total').innerText = '₦' + total.toFixed(2);
        }
    </script>
    
</head>
<body class="animsition">
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
    <main class="main-body">
    <div>
                
                    </div>
    <<div style="margin-top: 40px;">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <table style="margin-top: 40px;" class="table table-bordered">
                    <tr>
                        <th>Food Name</th>
                        <th>Category</th>
                        <th>Portion</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                    <?php
                    $total = 0;
                    if (isset($_SESSION['shopping-cart']) && !empty($_SESSION['shopping-cart'])) {
                        foreach ($_SESSION['shopping-cart'] as $dish) {
                            $dishId = $dish['dish_id'];
                            $dishImage = $dish['dish_image'];
                            $dishCategory = $dish['dish_category'];
                            $dishPortion = isset($dish['dish_portion']) ? $dish['dish_portion'] : '';
                            $dishTitle = $dish['dish_title'];
                            $dishPrice = $dish['dish_price'];
                            ?>
                            <tr>
                                <td>
                                    <div class="cart-info">
                                        <div>
                                            <p><b><?php echo $dishTitle; ?></b></p>
                                            <br>
                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                                <input type="hidden" name="dish_id" value="<?php echo $dishId; ?>">
                                                <button style="margin-top: -5px;" type="submit" name="remove_from_cart" class="btn btn-danger btn-sm remove-button">Remove</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                                <td><?php echo $dishCategory; ?></td>
                                <td><?php echo $dishPortion !== '' ? $dishPortion : 'Medium'; ?></td>
                                <td><input type="number" name="quantity" disabled value="1" style="border: 1px solid #202020;" onchange="calculateTotal()"></td>
                                <td>&#8358;<?php echo $dishPrice; ?></td>
                            </tr>
                            <?php
                            $total += $dishPrice;
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="5"><b>No dishes added to the cart.</b></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
                <div class="total-price">
                    <table>
                        <tr style="font-weight: bold;">
                            <td>Total</td>
                            <td id="total">&#8358;<?php echo $total; ?>.00</td>
                        </tr>
                    </table>
                </div>
                <button class="order-button" name="place_order">Place Order</button>
            </form>
        </div>

    </main>


</body>
</html>