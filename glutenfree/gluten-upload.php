<?php
require_once("../config/db.php");


// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form inputs
    $glutenImage = $_FILES['image']['name'];
    $glutenCategory = isset($_POST['gluten_category']) ? $_POST['gluten_category'] : '';
    $glutenTitle = isset($_POST['gluten_title']) ? $_POST['gluten_title'] : '';
    $glutenPortion = isset($_POST['gluten_portion']) ? $_POST['gluten_portion'] : [];
    $glutenPrice = isset($_POST['gluten_price']) ? $_POST['gluten_price'] : '';
    $glutenTime = isset($_POST['gluten_time']) ? $_POST['gluten_time'] : '';
    $glutenDescription = isset($_POST['gluten_desc']) ? $_POST['gluten_desc'] : '';

    // Validate the inputs
    $errors = [];

    // Validate the gluten image (you can modify this validation as per your requirements)
    if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        $errors[] = 'Error uploading the gluten image.';
    } else {
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $uploadedExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        if (!in_array($uploadedExtension, $allowedExtensions)) {
            $errors[] = 'Invalid file format. Only JPG, JPEG, and PNG files are allowed.';
        }
    }

    // Validate other inputs (add your own validation rules)
    if (empty($glutenImage) || empty($glutenCategory) || empty($glutenTitle) || empty($glutenPortion) || empty($glutenPrice) || empty($glutenTime) || empty($glutenDescription)) {
        $errors[] = 'Please fill in all the required fields.';
    }

    if (empty($errors)) {
        // Process the gluten portion as needed (e.g., convert array to a comma-separated string)
        $glutenPortionStr = implode(", ", array_values($glutenPortion));

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
        $stmt = $pdo->prepare("INSERT INTO glutens (image, gluten_category, gluten_title, gluten_portion, gluten_price, gluten_time, gluten_desc) VALUES (?, ?, ?, ?, ?, ?, ?)");

        // Execute the statement with the form inputs
        $stmt->execute([$glutenImage, $glutenCategory, $glutenTitle, $glutenPortionStr, $glutenPrice, $glutenTime, $glutenDescription]);

        // Redirect to the frontend page
        header("Location: ./glutenindex.php");
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

    <title>gluten Upload</title>
</head>
<body>
  
    <div class="container mt-5">

        <!-- <?php include('message.php'); ?> -->

        <div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>gluten Add</h4>
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
                            <input type="text" name="gluten_category" id="glutenCategory" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="glutenTitle">gluten Title:</label>
                            <input type="text" name="gluten_title" id="glutenTitle" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="glutenPortion">gluten Portion:</label>
                            <select name="gluten_portion[]" id="glutenPortion" class="form-select" multiple>
                                <option value="small">Small</option>
                                <option value="medium">Medium</option>
                                <option value="large">Large</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="glutenPrice">gluten Price (NGN):</label>
                            <input type="number" name="gluten_price" id="glutenPrice" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="glutenTime">gluten Time:</label>
                            <input type="text" name="gluten_time" id="glutenTime" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="glutenDescription">gluten Description:</label>
                            <textarea name="gluten_desc" id="glutenDescription" rows="4" class="form-control"></textarea>
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
