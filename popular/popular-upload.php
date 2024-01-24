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
        $stmt = $pdo->prepare("INSERT INTO populars (image, dish_category, dish_title, dish_portion, dish_price, dish_time, dish_desc) VALUES (?, ?, ?, ?, ?, ?, ?)");

        // Execute the statement with the form inputs
        $stmt->execute([$dishImage, $dishCategory, $dishTitle, $dishPortionStr, $dishPrice, $dishTime, $dishDescription]);

        // Redirect to the frontend page
        header("Location: ./popularindex.php");
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

    <title>Student Create</title>
</head>
<body>
  
    <div class="container mt-5">

        <!-- <?php include('message.php'); ?> -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Popular Dish Add
                            <a href="popularindex.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="dishImage">Dish Image:</label>
                            <input type="file" name="image" id="dishImage" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="dishCategory">Dish Category:</label>
                            <input type="text" name="dish_category" id="dishCategory" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="dishTitle">Dish Title:</label>
                        <input type="text" name="dish_title" id="dishTitle" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="dishPortion">Dish Portion:</label>
                            <select name="dish_portion[]" id="dishPortion" class="form-select" multiple>
                                <option value="small">Small</option>
                                <option value="medium">Medium</option>
                                <option value="large">Large</option>
                            </select>
                        </div>
                        <br>
                        <br><br>
                        <div class="mb-3">
                            <label for="dishPrice">Dish Price (NGN):</label>
                            <input type="number" name="dish_price" id="dishPrice" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="dishTime">Dish Time:</label>
                            <input type="text" name="dish_time" id="dishTime" class="form-control" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="dishDescription">Dish Description:</label>
                            <textarea name="dish_desc" id="dishDescription" rows="4" class="form-control"></textarea>
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
