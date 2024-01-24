<?php
require_once("../config/db.php");

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page if they are not logged in
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_order'])) {
        $orderId = $_POST['order_id'];
        
        // Delete the order from the `orders` table
        $deleteOrderQuery = "DELETE FROM orders WHERE order_id = ?";
        $deleteOrderStmt = $pdo->prepare($deleteOrderQuery);
        $deleteOrderStmt->execute([$orderId]);
        
        // Delete the order items from the `order_item` table
        $deleteOrderItemsQuery = "DELETE FROM order_item WHERE order_id = ?";
        $deleteOrderItemsStmt = $pdo->prepare($deleteOrderItemsQuery);
        $deleteOrderItemsStmt->execute([$orderId]);
        
        // Redirect to a confirmation page or any other desired page
        header("Location: ./order.php");
        exit();
    }
}
?>
