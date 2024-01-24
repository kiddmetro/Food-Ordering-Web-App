<?php
// session_start();
require_once("./config/db.php");
include("./config/function.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        $query = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
        $result = mysqli_query($db, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $userdata = mysqli_fetch_assoc($result);

            // Verify the hashed password
            if (password_verify($password, $userdata['password'])) {
                // Password is correct
                session_start();
                $_SESSION['user_id'] = $userdata['user_id'];
                header("Location: userprofile.php");
                exit();
            } else {
                // Password is incorrect
                echo "Invalid username or password.";
            }
        } else {
            // User not found
            echo "Invalid username or password.";
        }
    } else {
        // Fields are empty
        echo "Please enter a valid username and password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> </title>
    <link rel="stylesheet" href="./css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css" >
    <link rel="stylesheet" href="./css/login.css">
    <script src="./js/all.min.js"></script>
    <style type="text/css">
      #buttn{
        color:#fff;
        background-color: #FC8019;
      }
      #buttn:hover{
        background-color: #b45a11;
        cursor: pointer;
      }
    </style>
</head>


<body>
  <header class="top-header">
    <!-- <a href="./" class="brand-details">
        <i class="fa fa-cutlery"></i>
        <h1 class="brand-name">FoodiHub</h1>
    </a> -->
    <div class="brand-details">
        <img src="./images/logo.png" alt="site logo " width="90px"  >
        
    </div>

    <nav class="nav-bar2"> 
        <ul class="nav-wrap">
            <li><a href="./index.php" class="nav-link">Home</a></li>
            <li><a href="./menu.php" class="nav-link">Menu</a></li>
            <li><a href="./order" class="nav-link">Contact</a></li>
            <li><a href="./order" class="nav-link">Blogs</a></li>
        </ul>
    </nav>
    <div class="top-extra2">
        <a href="./userprofile.php" class="nav-link"><i class="fa fa-user"></i></a>
        <a href="./order.php" class="nav-link"><i class="fas fa-utensils"></i></a>
        <span class="nav-icon nav-cart"><a href="shoppingcart.php"><i class="fa fa-shopping-bag"></i> <p class="cart-label">0</p></a></span>
        
    </div>

        <span><a href="./signup.php" class="nav-sign2">Signup</a></span> 
        <span><a href="./login.php" class="nav-sign2">Login</a></span> 

        <!-- </div> -->
        <!-- <span class="nav-toggle"><i class="fa fa-bars"></i></span> -->
   
</header>
  <!-- Form Module-->
<div style="margin-top: 72px; ; padding-bottom: 40px; margin-bottom: 30px;" class="module form-module">
  <div class="toggle">
   
  </div>
  <div class="form">
    <h2>Login to your account</h2>
	  <!-- <span style="color:red;"><?php echo $message; ?></span> 
   <span style="color:green;"><?php echo $success; ?></span> -->
    <form action="" method="post">
      <input type="text" placeholder="Username"  name="username"/>
      <input type="password" placeholder="Password" name="password"/>
      <input type="submit" id="buttn" name="submit" value="login" />
    </form>
  </div>
  
  <div class="cta">Not registered?<a href="./signup.php" style="color:#FC8019;"> Create an account</a></div>
</div>


<footer class="base-footer">
  <div class="footer-details">
      <img src="./images/logo.png" alt="site logo " width="90px" style="background-color: #FC8019; display: flex;
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
  
</footer>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

</body>
