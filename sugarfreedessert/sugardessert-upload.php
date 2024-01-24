<?php
require_once("../config/db.php");


// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form inputs
    $sugardessertImage = $_FILES['image']['name'];
    $sugardessertCategory = isset($_POST['sugardessert_category']) ? $_POST['sugardessert_category'] : '';
    $sugardessertTitle = isset($_POST['sugardessert_title']) ? $_POST['sugardessert_title'] : '';
    $sugardessertPortion = isset($_POST['sugardessert_portion']) ? $_POST['sugardessert_portion'] : [];
    $sugardessertPrice = isset($_POST['sugardessert_price']) ? $_POST['sugardessert_price'] : '';
    $sugardessertTime = isset($_POST['sugardessert_time']) ? $_POST['sugardessert_time'] : '';
    $sugardessertDescription = isset($_POST['sugardessert_desc']) ? $_POST['sugardessert_desc'] : '';

    // Validate the inputs
    $errors = [];

    // Validate the sugardessert image (you can modify this validation as per your requirements)
    if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        $errors[] = 'Error uploading the sugardessert image.';
    } else {
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $uploadedExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        if (!in_array($uploadedExtension, $allowedExtensions)) {
            $errors[] = 'Invalid file format. Only JPG, JPEG, and PNG files are allowed.';
        }
    }

    // Validate other inputs (add your own validation rules)
    if (empty($sugardessertImage) || empty($sugardessertCategory) || empty($sugardessertTitle) || empty($sugardessertPortion) || empty($sugardessertPrice) || empty($sugardessertTime) || empty($sugardessertDescription)) {
        $errors[] = 'Please fill in all the required fields.';
    }

    if (empty($errors)) {
        // Process the sugardessert portion as needed (e.g., convert array to a comma-separated string)
        $sugardessertPortionStr = implode(", ", array_values($sugardessertPortion));

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
        $stmt = $pdo->prepare("INSERT INTO sugardesserts (image, sugardessert_category, sugardessert_title, sugardessert_portion, sugardessert_price, sugardessert_time, sugardessert_desc) VALUES (?, ?, ?, ?, ?, ?, ?)");

        // Execute the statement with the form inputs
        $stmt->execute([$sugardessertImage, $sugardessertCategory, $sugardessertTitle, $sugardessertPortionStr, $sugardessertPrice, $sugardessertTime, $sugardessertDescription]);

        // Redirect to the frontend page
        header("Location: ./sugardessertindex.php");
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

    <title>sugardessert Upload</title>
</head>
<body>
  
    <div class="container mt-5">

        <!-- <?php include('message.php'); ?> -->

        <div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Sugardessert Add</h4>
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
                            <input type="text" name="sugardessert_category" id="sugardessertCategory" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="sugardessertTitle">sugardessert Title:</label>
                            <input type="text" name="sugardessert_title" id="sugardessertTitle" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="sugardessertPortion">sugardessert Portion:</label>
                            <select name="sugardessert_portion[]" id="sugardessertPortion" class="form-select" multiple>
                                <option value="small">Small</option>
                                <option value="medium">Medium</option>
                                <option value="large">Large</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="sugardessertPrice">sugardessert Price (NGN):</label>
                            <input type="number" name="sugardessert_price" id="sugardessertPrice" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="sugardessertTime">sugardessert Time:</label>
                            <input type="text" name="sugardessert_time" id="sugardessertTime" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="sugardessertDescription">sugardessert Description:</label>
                            <textarea name="sugardessert_desc" id="sugardessertDescription" rows="4" class="form-control"></textarea>
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
