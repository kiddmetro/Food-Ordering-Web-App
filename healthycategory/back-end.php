<?php

require_once("../config/db.php");

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form inputs
    $saladImage = $_FILES['image']['name'];
    $saladCategory = isset($_POST['salad_category']) ? $_POST['salad_category'] : '';
    $saladTitle = isset($_POST['salad_title']) ? $_POST['salad_title'] : '';
    $saladPortion = isset($_POST['salad_portion']) ? $_POST['salad_portion'] : [];
    $saladPrice = isset($_POST['salad_price']) ? $_POST['salad_price'] : '';
    $saladTime = isset($_POST['salad_time']) ? $_POST['salad_time'] : '';
    $saladDescription = isset($_POST['salad_desc']) ? $_POST['salad_desc'] : '';

    // Validate the inputs
    $errors = [];

    // Validate the salad image (you can modify this validation as per your requirements)
    if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        $errors[] = 'Error uploading the salad image.';
    } else {
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $uploadedExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        if (!in_array($uploadedExtension, $allowedExtensions)) {
            $errors[] = 'Invalid file format. Only JPG, JPEG, and PNG files are allowed.';
        }
    }

    // Validate other inputs (add your own validation rules)
    if (empty($saladImage) || empty($saladCategory) || empty($saladTitle) || empty($saladPortion) || empty($saladPrice) || empty($saladTime) || empty($saladDescription)) {
        $errors[] = 'Please fill in all the required fields.';
    }

    if (empty($errors)) {
        // Process the salad portion as needed (e.g., convert array to a comma-separated string)
        $saladPortionStr = implode(", ", array_values($saladPortion));

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
        $stmt = $pdo->prepare("INSERT INTO salads (image, salad_category, salad_title, salad_portion, salad_price, salad_time, salad_desc) VALUES (?, ?, ?, ?, ?, ?, ?)");

        // Execute the statement with the form inputs
        $stmt->execute([$saladImage, $saladCategory, $saladTitle, $saladPortionStr, $saladPrice, $saladTime, $saladDescription]);

        // Redirect to the frontend page
        header("Location: ./healthysaladindex.php");
        exit();
    }
}
?>