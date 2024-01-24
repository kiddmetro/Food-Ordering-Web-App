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

    <title>Salad Edit</title>
</head>
<body>
  
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Healthy Salad Edit 
                            <a href="healthysaladindex.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['salad_id']))
                        {
                            $id = mysqli_real_escape_string($db, $_GET['salad_id']);
                            $query = "SELECT * FROM salads WHERE salad_id ='$id' ";
                            $query_run = mysqli_query($db, $query);
                        
                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $salad = mysqli_fetch_array($query_run);
                                
                                ?>
                                <form action="backend.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?= $salad['salad_id']; ?>">
                        
                                    <div class="mb-3">
                                        <label>Image</label>
                                        <input type="file" name="image" value="<?= $salad['image']; ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Category</label>
                                        <input type="text" name="salad_category" value="<?= $salad['salad_category']; ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Title</label>
                                        <input type="text" name="salad_title" value="<?= $salad['salad_title']; ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Price</label>
                                        <input type="number" name="salad_price" value="<?= $salad['salad_price']; ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Time</label>
                                        <input type="text" name="salad_time" value="<?= $salad['salad_time']; ?>" class="form-control">
                                    </div>
                        
                        
                                    <div class="mb-3">
                                        <label>Description</label>
                                        <input type="text" name="salad_desc" value="<?= $salad['salad_desc']; ?>" class="form-control">
                                    </div>
                        
                                    <div class="mb-3">
                                        <button type="submit" name="update_salad" class="btn btn-primary">
                                            Update salad
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