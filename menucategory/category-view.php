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

    <title>Category </title>
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
                <li><a href="../menus/menuindex.php" class="nav-link">Menu</a></li>
                <li><a href="./categoryindex.php" class="nav-link">Category</a></li>
                <li><a href="../orders/orderindex.php" class="nav-link">Orders</a></li>
                <li><a href="./order" class="nav-link">Contact</a></li>
                <li><a href="./order" class="nav-link">Blogs</a></li>
            </ul>
        </nav>
        <div class="top-extra2">
            <a href="./userprofile.php" class="nav-link"><i class="fa fa-user"></i></a>

            
           
            
        </div>

           
          
            <a href="categoryindex.php" class="nav-sign2">Back</a>
  
       
    </header>
<body>

   
<div style="margin-top: 70px; margin-left: 50px;" class="">

<?php include('message.php'); ?>

<div class="row">
    <div class="">
        <div style="margin-top: 40px;">
            <div style="margin-top: 40px;">
                <h4>Category Information
                    <!-- <a href="student-create.php" class="btn btn-primary float-end">Add Students</a> -->
                </h4>
            </div>
            <div class="card-body">

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Category Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Healthy Salad</td>
                            <td> 
                                <a href="../healthycategory/salad-upload.php" class="btn btn-success btn-sm">Upload</a>
                                <a href="../healthycategory/healthysaladindex.php" class="btn btn-info btn-sm">View</a>
                                            <form action="../healthycategory/backcode.php" method="POST" class="d-inline">
                                                <button type="submit" name="delete_salad" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                      
                          </td>
                        </tr>
                                    
                        
                        <tr>
                            <td>2</td>
                            <td>Non Dairy</td>
                            <td> 
                                <a href="../nondairycategory/nondairy-upload.php" class="btn btn-success btn-sm">Upload</a>
                                <a href="../nondairycategory/nondairyindex.php" class="btn btn-info btn-sm">View</a>
                                            <form action="..//nondairycategory/backcode.php" method="POST" class="d-inline">
                                                <button type="submit" name="delete_nondairy" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                      
                          </td>
                        </tr>


                        <tr>
                            <td>3</td>
                            <td>Gluten Free</td>
                            <td> 
                                <a href="../glutenfree/gluten-upload.php" class="btn btn-success btn-sm">Upload</a>
                                <a href="../glutenfree/glutenindex.php" class="btn btn-info btn-sm">View</a>
                                            <form action="../glutenfree/backcode.php" method="POST" class="d-inline">
                                                <button type="submit" name="delete_gluten" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                      
                          </td>
                        </tr>


                        <tr>
                            <td>4</td>
                            <td>Vegan</td>
                            <td> 
                                <a href="../vegan/vegan-upload.php" class="btn btn-success btn-sm">Upload</a>
                                <a href="../vegan/veganindex.php" class="btn btn-info btn-sm">View</a>
                                            <form action="../vegan/backcode.php" method="POST" class="d-inline">
                                                <button type="submit" name="delete_vegan" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                      
                          </td>
                        </tr>

                        <tr>
                            <td>4</td>
                            <td>Sugar Free Dessert</td>
                            <td> 
                                <a href="../sugarfreedessert/sugardessert-upload.php" class="btn btn-success btn-sm">Upload</a>
                                <a href="../sugarfreedessert/sugardessertindex.php" class="btn btn-info btn-sm">View</a>
                                            <form action="../sugarfreedessert/backcode.php" method="POST" class="d-inline">
                                                <button type="submit" name="delete_sugardessert" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                      
                          </td>
                        </tr>

                        
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