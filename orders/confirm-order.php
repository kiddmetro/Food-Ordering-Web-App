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

    <title>Confrim Order</title>
</head>
<body>
  
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Confrim Order
                            <a href="orderindex.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['order_id']))
                        {
                            $id = mysqli_real_escape_string($db, $_GET['order_id']);
                            $query = "SELECT * FROM orders WHERE order_id ='$id' ";
                            $query_run = mysqli_query($db, $query);
                        
                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $order = mysqli_fetch_array($query_run);
                                
                                ?>
                                <form action="backcode.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?= $order['order_id']; ?>">
                        
                                    <div class="mb-3">
                                        <label>Confrim Order</label>
                                        <input type="number" name="is_confirmed" value="<?= $order['is_confirmed']; ?>" class="form-control">
                                    </div>
                        
                                    <div class="mb-3">
                                        <button type="submit" name="confirm-order" class="btn btn-primary">
                                           Confrim Order
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