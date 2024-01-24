<?php

require_once("../config/db.php");

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form inputs
    $categoryImage = $_FILES['image']['name'];
    $categoryTitle = isset($_POST['category_title']) ? $_POST['category_title'] : '';
    $categoryDescription = isset($_POST['category_desc']) ? $_POST['category_desc'] : '';

    // Validate the inputs
    $errors = [];

    // Validate the dish image (you can modify this validation as per your requirements)
    if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        $errors[] = 'Error uploading the category image.';
    } else {
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $uploadedExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        if (!in_array($uploadedExtension, $allowedExtensions)) {
            $errors[] = 'Invalid file format. Only JPG, JPEG, and PNG files are allowed.';
        }
    }

    // Validate other inputs (add your own validation rules)
    if (empty($categoryImage) || empty($categoryTitle) || empty($categoryDescription)) {
        $errors[] = 'Please fill in all the required fields.';
    }

    if (empty($errors)) {
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
        $stmt = $pdo->prepare("INSERT INTO categorys (image, category_title, category_desc) VALUES (?, ?, ?)");

        // Execute the statement with the form inputs
        $stmt->execute([$categoryImage, $categoryTitle, $categoryDescription]);

        // Redirect to the frontend page
        header("Location: ./category-upload.php");
        exit();
    }
}
?>
