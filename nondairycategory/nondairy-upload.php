<?php
require_once("../config/db.php");


// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form inputs
    $nondairyImage = $_FILES['image']['name'];
    $nondairyCategory = isset($_POST['nondairy_category']) ? $_POST['nondairy_category'] : '';
    $nondairyTitle = isset($_POST['nondairy_title']) ? $_POST['nondairy_title'] : '';
    $nondairyPortion = isset($_POST['nondairy_portion']) ? $_POST['nondairy_portion'] : [];
    $nondairyPrice = isset($_POST['nondairy_price']) ? $_POST['nondairy_price'] : '';
    $nondairyTime = isset($_POST['nondairy_time']) ? $_POST['nondairy_time'] : '';
    $nondairyDescription = isset($_POST['nondairy_desc']) ? $_POST['nondairy_desc'] : '';

    // Validate the inputs
    $errors = [];

    // Validate the nondairy image (you can modify this validation as per your requirements)
    if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        $errors[] = 'Error uploading the nondairy image.';
    } else {
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $uploadedExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        if (!in_array($uploadedExtension, $allowedExtensions)) {
            $errors[] = 'Invalid file format. Only JPG, JPEG, and PNG files are allowed.';
        }
    }

    // Validate other inputs (add your own validation rules)
    if (empty($nondairyImage) || empty($nondairyCategory) || empty($nondairyTitle) || empty($nondairyPortion) || empty($nondairyPrice) || empty($nondairyTime) || empty($nondairyDescription)) {
        $errors[] = 'Please fill in all the required fields.';
    }

    if (empty($errors)) {
        // Process the nondairy portion as needed (e.g., convert array to a comma-separated string)
        $nondairyPortionStr = implode(", ", array_values($nondairyPortion));

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
        $stmt = $pdo->prepare("INSERT INTO nondairys (image, nondairy_category, nondairy_title, nondairy_portion, nondairy_price, nondairy_time, nondairy_desc) VALUES (?, ?, ?, ?, ?, ?, ?)");

        // Execute the statement with the form inputs
        $stmt->execute([$nondairyImage, $nondairyCategory, $nondairyTitle, $nondairyPortionStr, $nondairyPrice, $nondairyTime, $nondairyDescription]);

        // Redirect to the frontend page
        header("Location: ./nondairyindex.php");
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

    <title>Nondairy Upload</title>
</head>
<body>
  
    <div class="container mt-5">

        <!-- <?php include('message.php'); ?> -->

        <div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Nondairy Add</h4>
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
                            <label for="dishImage">Non Dairy Image:</label>
                            <input type="file" name="image" id="dishImage" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="dishCategory">Category:</label>
                            <input type="text" name="nondairy_category" id="nondairyCategory" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="nondairyTitle">nondairy Title:</label>
                            <input type="text" name="nondairy_title" id="nondairyTitle" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="nondairyPortion">Portion:</label>
                            <select name="nondairy_portion[]" id="nondairyPortion" class="form-select" multiple>
                                <option value="small">Small</option>
                                <option value="medium">Medium</option>
                                <option value="large">Large</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="nondairyPrice">Price (NGN):</label>
                            <input type="number" name="nondairy_price" id="nondairyPrice" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="nondairyTime">Time:</label>
                            <input type="text" name="nondairy_time" id="nondairyTime" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="nondairyDescription">Description:</label>
                            <textarea name="nondairy_desc" id="nondairyDescription" rows="4" class="form-control"></textarea>
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
