<?php
require_once("../config/db.php");


// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form inputs
    $veganImage = $_FILES['image']['name'];
    $veganCategory = isset($_POST['vegan_category']) ? $_POST['vegan_category'] : '';
    $veganTitle = isset($_POST['vegan_title']) ? $_POST['vegan_title'] : '';
    $veganPortion = isset($_POST['vegan_portion']) ? $_POST['vegan_portion'] : [];
    $veganPrice = isset($_POST['vegan_price']) ? $_POST['vegan_price'] : '';
    $veganTime = isset($_POST['vegan_time']) ? $_POST['vegan_time'] : '';
    $veganDescription = isset($_POST['vegan_desc']) ? $_POST['vegan_desc'] : '';

    // Validate the inputs
    $errors = [];

    // Validate the vegan image (you can modify this validation as per your requirements)
    if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        $errors[] = 'Error uploading the vegan image.';
    } else {
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $uploadedExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        if (!in_array($uploadedExtension, $allowedExtensions)) {
            $errors[] = 'Invalid file format. Only JPG, JPEG, and PNG files are allowed.';
        }
    }

    // Validate other inputs (add your own validation rules)
    if (empty($veganImage) || empty($veganCategory) || empty($veganTitle) || empty($veganPortion) || empty($veganPrice) || empty($veganTime) || empty($veganDescription)) {
        $errors[] = 'Please fill in all the required fields.';
    }

    if (empty($errors)) {
        // Process the vegan portion as needed (e.g., convert array to a comma-separated string)
        $veganPortionStr = implode(", ", array_values($veganPortion));

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
        $stmt = $pdo->prepare("INSERT INTO vegans (image, vegan_category, vegan_title, vegan_portion, vegan_price, vegan_time, vegan_desc) VALUES (?, ?, ?, ?, ?, ?, ?)");

        // Execute the statement with the form inputs
        $stmt->execute([$veganImage, $veganCategory, $veganTitle, $veganPortionStr, $veganPrice, $veganTime, $veganDescription]);

        // Redirect to the frontend page
        header("Location: ./veganindex.php");
        exit();
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="../css/bootstrap.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>vegan Upload</title>
</head>
<body>
  
    <div class="container mt-5">

        <!-- <?php include('message.php'); ?> -->

        <div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>vegan Add</h4>
                </div>
                <div class="card-body">
                    <?php if (!empty($errors)) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php foreach ($errors as $error) : ?>
                                <p><?php echo $error; ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="dishImage">Dish Image:</label>
                            <input type="file" name="image" id="dishImage" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="dishCategory">Dish Category:</label>
                            <input type="text" name="vegan_category" id="veganCategory" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="veganTitle">vegan Title:</label>
                            <input type="text" name="vegan_title" id="veganTitle" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="veganPortion">vegan Portion:</label>
                            <select name="vegan_portion[]" id="veganPortion" class="form-select" multiple>
                                <option value="small">Small</option>
                                <option value="medium">Medium</option>
                                <option value="large">Large</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="veganPrice">vegan Price (NGN):</label>
                            <input type="number" name="vegan_price" id="veganPrice" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="veganTime">vegan Time:</label>
                            <input type="text" name="vegan_time" id="veganTime" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="veganDescription">vegan Description:</label>
                            <textarea name="vegan_desc" id="veganDescription" rows="4" class="form-control"></textarea>
                        </div>
                        <div>
                            <input type="submit" value="Upload" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>
