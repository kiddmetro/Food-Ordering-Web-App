<?php

require_once("../config/db.php");

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form inputs
    $dishImage = $_FILES['image']['name'];
    $dishCategory = isset($_POST['dish_category']) ? $_POST['dish_category'] : '';
    $dishTitle = isset($_POST['dish_title']) ? $_POST['dish_title'] : '';
    $dishPortion = isset($_POST['dish_portion']) ? $_POST['dish_portion'] : [];
    $dishPrice = isset($_POST['dish_price']) ? $_POST['dish_price'] : '';
    $dishTime = isset($_POST['dish_time']) ? $_POST['dish_time'] : '';
    $dishDescription = isset($_POST['dish_desc']) ? $_POST['dish_desc'] : '';

    // Validate the inputs
    $errors = [];

    // Validate the dish image (you can modify this validation as per your requirements)
    if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        $errors[] = 'Error uploading the dish image.';
    } else {
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $uploadedExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        if (!in_array($uploadedExtension, $allowedExtensions)) {
            $errors[] = 'Invalid file format. Only JPG, JPEG, and PNG files are allowed.';
        }
    }

    // Validate other inputs (add your own validation rules)
    if (empty($dishImage) || empty($dishCategory) || empty($dishTitle) || empty($dishPortion) || empty($dishPrice) || empty($dishTime) || empty($dishDescription)) {
        $errors[] = 'Please fill in all the required fields.';
    }

    if (empty($errors)) {
        // Process the dish portion as needed (e.g., convert array to a comma-separated string)
        $dishPortionStr = implode(", ", array_values($dishPortion));

        // Save the inputs in the database
        // Replace the database connection and table name with your own
        $host = 'localhost';
        $db = 'fooddeliver_database';
        $user = 'root';
        $password = '';

        // Create a PDO instance
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the SQL statement
        $stmt = $pdo->prepare("INSERT INTO menus (image, dish_category, dish_title, dish_portion, dish_price, dish_time, dish_desc) VALUES (?, ?, ?, ?, ?, ?, ?)");

        // Execute the statement with the form inputs
        $stmt->execute([$dishImage, $dishCategory, $dishTitle, $dishPortionStr, $dishPrice, $dishTime, $dishDescription]);

        // Redirect to the frontend page
        header("Location: ./menuindex.php");
        exit();
    }
}
?>