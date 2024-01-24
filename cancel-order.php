<?php
require_once("./config/db.php");

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['cancel_order'])) {
        $orderId = $_POST['order_id'];
        
        // Check if the order is pending (not confirmed)
        $checkOrderStatusQuery = "SELECT is_confirmed FROM orders WHERE order_id = ?";
        $checkOrderStatusStmt = $pdo->prepare($checkOrderStatusQuery);
        $checkOrderStatusStmt->execute([$orderId]);
        $orderStatus = $checkOrderStatusStmt->fetchColumn();
        
        if ($orderStatus == 0) {
            // Update the `is_confirmed` field to 0 (cancelled) in the `orders` table
            $cancelOrderQuery = "UPDATE orders SET is_confirmed = 0 WHERE order_id = ?";
            $cancelOrderStmt = $pdo->prepare($cancelOrderQuery);
            $cancelOrderStmt->execute([$orderId]);
        }
        
        // Redirect to a confirmation page or any other desired page
        header("Location: ./order.php");
        exit();
    }
}
?>
