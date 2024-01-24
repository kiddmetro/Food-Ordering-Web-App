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

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="../css/bootstrap.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Salad Upload</title>
</head>
<body>
  
    <div class="container mt-5">

        <!-- <?php include('message.php'); ?> -->

        <div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Salad Add</h4>
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
                            <input type="text" name="salad_category" id="saladCategory" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="saladTitle">Salad Title:</label>
                            <input type="text" name="salad_title" id="saladTitle" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="saladPortion">Salad Portion:</label>
                            <select name="salad_portion[]" id="saladPortion" class="form-select" multiple>
                                <option value="small">Small</option>
                                <option value="medium">Medium</option>
                                <option value="large">Large</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="saladPrice">Salad Price (NGN):</label>
                            <input type="number" name="salad_price" id="saladPrice" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="saladTime">Salad Time:</label>
                            <input type="text" name="salad_time" id="saladTime" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="saladDescription">Salad Description:</label>
                            <textarea name="salad_desc" id="saladDescription" rows="4" class="form-control"></textarea>
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
