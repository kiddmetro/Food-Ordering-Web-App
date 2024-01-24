<?php
require_once("../config/db.php");
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Gluten Edit</title>
</head>
<body>
  
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Gluten Edit 
                            <a href="glutenindex.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['gluten_id']))
                        {
                            $id = mysqli_real_escape_string($db, $_GET['gluten_id']);
                            $query = "SELECT * FROM glutens WHERE gluten_id ='$id' ";
                            $query_run = mysqli_query($db, $query);
                        
                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $gluten = mysqli_fetch_array($query_run);
                                
                                ?>
                                <form action="backcode.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?= $gluten['gluten_id']; ?>">
                        
                                    <div class="mb-3">
                                        <label>Image</label>
                                        <input type="file" name="image" value="<?= $gluten['image']; ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Category</label>
                                        <input type="text" name="gluten_category" value="<?= $gluten['gluten_category']; ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Title</label>
                                        <input type="text" name="gluten_title" value="<?= $gluten['gluten_title']; ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Price</label>
                                        <input type="number" name="gluten_price" value="<?= $gluten['gluten_price']; ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Time</label>
                                        <input type="text" name="gluten_time" value="<?= $gluten['gluten_time']; ?>" class="form-control">
                                    </div>
                        
                        
                                    <div class="mb-3">
                                        <label>Description</label>
                                        <input type="text" name="gluten_desc" value="<?= $gluten['gluten_desc']; ?>" class="form-control">
                                    </div>
                        
                                    <div class="mb-3">
                                        <button type="submit" name="update_gluten" class="btn btn-primary">
                                            Update Gluten
                                        </button>
                                    </div>
                                </form>
                                <?php
                            }
                            else
                            {
                                echo "<h4>No Such ID Found</h4>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>