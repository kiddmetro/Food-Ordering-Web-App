<?php
require_once("../config/db.php")
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Popular Dishes Edit</title>
</head>
<body>
  
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Popular Edit 
                            <a href="popularindex.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['popular_id']))
                        {
                            $id = mysqli_real_escape_string($db, $_GET['popular_id']);
                            $query = "SELECT * FROM populars WHERE popular_id ='$id' ";
                            $query_run = mysqli_query($db, $query);
                        
                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $popular = mysqli_fetch_array($query_run);
                                
                                ?>
                                <form action="backcode.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?= $popular['popular_id']; ?>">
                        
                                    <div class="mb-3">
                                        <label>Image</label>
                                        <input type="file" name="image" value="<?= $popular['image']; ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Category</label>
                                        <input type="text" name="dish_category" value="<?= $popular['dish_category']; ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Title</label>
                                        <input type="text" name="dish_title" value="<?= $popular['dish_title']; ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Price</label>
                                        <input type="number" name="dish_price" value="<?= $popular['dish_price']; ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Time</label>
                                        <input type="text" name="dish_time" value="<?= $popular['dish_time']; ?>" class="form-control">
                                    </div>
                        
                        
                                    <div class="mb-3">
                                        <label>Description</label>
                                        <input type="text" name="dish_desc" value="<?= $popular['dish_desc']; ?>" class="form-control">
                                    </div>
                        
                                    <div class="mb-3">
                                        <button type="submit" name="update_popular" class="btn btn-primary">
                                            Update popular
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