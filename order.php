<?php

  // session_start(); 
  require_once("./config/db.php"); //the keeps the file and also doesnt show the page if path is wrong
  require_once("./config/function.php");

  // Establish a database connection using PDO
try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit();
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page if they are not logged in
    header("Location: ./login.php");
    exit();
}

// Retrieve the user's order from the database
$userId = $_SESSION['user_id'];
$ordersQuery = "SELECT * FROM orders WHERE user_id = ?";
$orderStmt = $pdo->prepare($ordersQuery);
$orderStmt->execute([$userId]);
$orders = $orderStmt->fetchAll(PDO::FETCH_ASSOC);
  

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
    
</head>
<body >
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
                <li><a href="" class="nav-link">Contact</a></li>
                <li><a href="" class="nav-link">Blogs</a></li>
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
                    <div style="margin-top: 40px;" class="">
    <h2 style="margin-top: 80px; margin-bottom: 40px;">Your Orders</h2>
    <?php if (count($orders) > 0): ?>
        <?php foreach ($orders as $order): ?>
            <?php
            $orderStatus = $order['is_confirmed'] ? 'Confirmed' : 'Pending';
            $statusColor = $order['is_confirmed'] ? 'green' : 'blue';
            ?>
            <div>
                <h3 style="background-color: #ff8019;">Order ID: <?php echo $order['order_id']; ?></h3>
                <p>Total Amount: ₦<?php echo $order['total_amount']; ?></p>

                <?php
                // Retrieve the order items for the current order
                $orderId = $order['order_id'];
                $getOrderItemsQuery = "SELECT * FROM order_item WHERE order_id = ?";
                $orderItemsStmt = $pdo->prepare($getOrderItemsQuery);
                $orderItemsStmt->execute([$orderId]);
                $orderItems = $orderItemsStmt->fetchAll(PDO::FETCH_ASSOC);
                ?>

                <?php if (count($orderItems) > 0): ?>
                    <table>
                        <tr>
                            <th style="background-color: #fff; color:#202020; font-weight:bold; font-size: 20px; ">Dish</th>
                            <th style="background-color: #fff; color:#202020; font-weight:bold; font-size: 20px; ">Price</th>
                        </tr>
                        <?php foreach ($orderItems as $item): ?>
                            <tr>
                                <td><?php echo $item['dish_title']; ?></td>
                                <td>₦<?php echo $item['price']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php endif; ?>
                <p style="color: <?php echo $statusColor; ?>"><b>Order Status: <?php echo $orderStatus; ?></b></p>
                <?php
                if ($order['is_confirmed'] == 0) {
                    // Add a button to cancel the order if it is not confirmed
                    echo '<form action="./cancel-order.php" method="POST">';
                    echo '<input type="hidden" name="order_id" value="' . $order['order_id'] . '">';
                    echo '<button type="submit" name="cancel_order" class="btn btn-danger btn-sm">Cancel Order</button>';
                    echo '</form>';
                    
                } else {
                    // Remove the cancel button and replace it with a delete history button
                    echo '<form action="./delete-history.php" method="POST">';
                    echo '<input type="hidden" name="order_id" value="' . $order['order_id'] . '">';
                    echo '<button type="submit" name="delete_history" class="btn btn-danger btn-sm">Delete Order History</button>';
                    echo '</form>';
                }
                ?>
            </div>
            <hr>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No orders found.</p>
    <?php endif; ?>

    <!-- Add your additional HTML elements as needed -->
</div>
</body>
</html>
