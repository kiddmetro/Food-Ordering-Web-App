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
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="../admin/css/style.css">
    <link rel="stylesheet" href="../admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="../admin/css/all.min.css">

    <title>Order</title>
</head>
<body>
<header class="top-header">
        <!-- <a href="./" class="brand-details">
            <i class="fa fa-cutlery"></i>
            <h1 class="brand-name">FoodiHub</h1>
        </a> -->
        <div class="brand-details">
            <img src="../images/logo.png" alt="site logo " width="90px"  >
            
        </div>

        <nav class="nav-bar2"> 
            <ul class="nav-wrap">
                <li><a href="../admin/homeadmin.php" class="nav-link">Home</a></li>
                <li><a href="../admin/index.php" class="nav-link">Users</a></li>
                <li><a href="./menuindex.php" class="nav-link">Menu</a></li>
                <li><a href="../menucategory/categoryindex.php" class="nav-link">Category</a></li>
                <li><a href="./orderindex.php" class="nav-link">Orders</a></li>
                <li><a href="./order" class="nav-link">Contact</a></li>
                <li><a href="./order" class="nav-link">Blogs</a></li>
            </ul>
        </nav>
        <div class="top-extra2">
            <a href="./userprofile.php" class="nav-link"><i class="fa fa-user"></i></a>
            
           
            
        </div>

           
            <span><a href="./login.php" class="nav-sign2">Login</a></span> 
            <span><a href="order-items.php?>" class="nav-sign2">View Order Items</a></span>
  
            <!-- </div> -->
            <!-- <span class="nav-toggle"><i class="fa fa-bars"></i></span> -->
       
    </header>
    
  
    <div style="margin-top: 70px; margin-left: 50px;" class="">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="">
                <div style="margin-top: 40px;">
                    <div style="margin-top: 40px;">
                        <h4>Order Information
                            <!-- <a href="student-create.php" class="btn btn-primary float-end">Add Students</a> -->
                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>UserID</th>
                                    <th>Total Amount</th>
                                    <th>User Name</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Health Challenges</th>
                                    <th>Address</th>
                                    <th>Confrimation</th>
                                    <th>Order Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $query = "SELECT * FROM orders";
                                    $query_run = mysqli_query($db, $query);

                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $order)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $order['order_id']; ?></td>
                                                <td><?= $order['user_id']; ?></td>
                                                <td><?= $order['total_amount']; ?></td>
                                                <td><?= $order['username']; ?></td>
                                                <td><?= $order['firstname']; ?></td>
                                                <td><?= $order['lastname']; ?></td>
                                                <td><?= $order['phone']; ?></td>
                                                <td><?= $order['email']; ?></td>
                                                <td><?= $order['healthchallenges']; ?></td>
                                                <td><?= $order['address']; ?></td>
                                                <td><?= $order['is_confirmed']; ?></td>
                                                <td><?= $order['order_date']; ?></td>

                                                <td>
                                                    
                                                    <a href="confirm-order.php?order_id=<?= $order['order_id']; ?>" class="btn btn-success btn-sm">Confrim</a>
                                                    <form action="backcode.php" method="POST" class="d-inline">
                                                        <button type="submit" name="delete_order" value="<?=$order['order_id'];?>" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "<h5> No Record Found </h5>";
                                    }
                                ?>
                                
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <footer class="base-footer">
        <div class="footer-details">
            <img src="../images/logo.png" alt="site logo " width="90px" style="background-color: #FC8019; display: flex;
            justify-content: left; margin: 40px 0px 40px 60px; " >
        </div>

        <nav class="footer-bar"> 
            <ul class="footer-wrap">
                <a href="./" class="footer-link">About us</a>
                <a href="./" class="footer-link">Delivery</a>
                <a href="./" class="footer-link">Help & Support</a>
                <a href="./" class="footer-link">T&C</a>
                
            </ul>
        </nav>
        <div class="footer-extra">
            <a href="#" id="Twitter"  class="fab fa-twitter footer-link"></a>
            <a href="#" id="Facebook" class="fab fa-facebook footer-link"></a>
            <a href="#" id="Instagram" class="fab fa-instagram footer-link"></a>
           
        </div>
        
    </footer> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/all.min.js"></script>

</body>
</html>