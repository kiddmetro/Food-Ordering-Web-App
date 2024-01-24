<?php
$message = ""; 
$success = ""; 
  
require_once("./config/db.php"); // The file that keeps the database connection
include("./config/function.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $username = $db->real_escape_string($_POST['username']);
  $firstname = $db->real_escape_string($_POST['firstname']);
  $lastname = $db->real_escape_string($_POST['lastname']);
  $email = $db->real_escape_string($_POST['email']);
  $phone = $db->real_escape_string($_POST['phone']);
  $password = $db->real_escape_string($_POST['password']);
  $dob = $db->real_escape_string($_POST['dob']);
  $address = $db->real_escape_string($_POST['address']);

  // Generate a random salt
  $salt = generateSalt(); // Custom function to generate a salt

  // Encrypt the password
  $hashedPassword = crypt($password, $salt);

  if (!empty($username) && !empty($hashedPassword) && isset($_POST['gender']) && isset($_POST['healthchallenges'])) {
    $gender = $_POST['gender'];
    $healthchallenges = $_POST['healthchallenges'];

    // Check if username or email already exists
    $query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      if ($row['username'] === $username) {
        $message = "Username already taken";
      } else if ($row['email'] === $email) {
        $message = "Email already exists";
      }
    } else {
      // Password validation checks
      if (strlen($password) < 6 || !preg_match("/[A-Z]/", $password) || !preg_match("/[a-z]/", $password) || !preg_match("/[0-9]/", $password)) {
        $message = "Password must be at least 6 characters long and contain at least one uppercase letter, one lowercase letter, and one number.";
      } else {
        // Insert data into database
        $query = "INSERT INTO users (username, firstname, lastname, email, phone, gender, password, dob, healthchallenges, address)
                  VALUES ('$username', '$firstname', '$lastname', '$email', '$phone', '$gender', '$hashedPassword', '$dob', '$healthchallenges', '$address')";

        if (mysqli_query($db, $query)) {
          
          $success = "Account Created successfully! <p>You will be redirected in <span id='counter'>5</span> second(s).</p>
          <script type='text/javascript'>
          function countdown() {
            var i = document.getElementById('counter');
            if (parseInt(i.innerHTML)<=0) {
              location.href = 'login.php';
            }
            i.innerHTML = parseInt(i.innerHTML)-1;
          }
          setInterval(function(){ countdown(); },1000);
          </script>'";




header("refresh:5;url=login.php"); // redirected once inserted success
          
          

          // header("Location: login.php");
          // exit();
        } else {
          $message = "Error: Failed to insert data into the database.";
        }
      }
    }
  } else {
    $message = "Please enter some valid information";
  }
} else {
  unset($_POST['username'], $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['phone'], $_POST['password'], $_POST['dob'], $_POST['address']);
  $message = "";
}

// Function to generate a random salt
function generateSalt($length = 22) {
  $charset = './ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
  $salt = '';
  for ($i = 0; $i < $length; $i++) {
    $salt .= $charset[mt_rand(0, strlen($charset) - 1)];
  }
  return $salt;
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
    <link rel="stylesheet" href="./css/bootstrap.min.css" >
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	  <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
  	<link rel="stylesheet" type="text/css" href="fonts/linearicons-v1.0.0/icon-font.min.css">
    <script src="./js/all.min.js"></script>
    <style>
  .overlay {
    display: none;
    position: fixed;
    z-index: 9999;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    align-items: center;
    justify-content: center;
  }

  .overlay-message {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 30px;
    border-radius: 10px;
    background-color: #fff;
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
            <a href="#dishes" class="nav-link"><i class="fas fa-utensils"></i></a>
            <span class="nav-icon nav-cart"><a href="shopping-cart.php"><i class="fa fa-shopping-bag"></i> <p class="cart-label">0</p></a></span>
            
        </div>

            <span><a href="./signup.php" class="nav-sign2">Signup</a></span> 
            <span><a href="./login.php" class="nav-sign2">Login</a></span> 
  
            <!-- </div> -->
            <!-- <span class="nav-toggle"><i class="fa fa-bars"></i></span> -->
       
    </header>
    
    <main class="main-body">
      <div style="margin-top: 60px"; class = "page-wrapper">
        <div class="breadcrumb">
           <div class="container">
              <ul>
                 <li><a href="#" class="active">
        <span style="color:red;"><?php echo $message; ?></span>
         <span style="color:green;">
            <?php echo $success; ?>
                </span>
         
      </a></li>
                
              </ul>
           </div>
        </div>
      <section style="margin-top: 50px;" class="contact-page inner-page">
        <div class="container">
          <div class="row">
           <!-- REGISTER -->
           <div class="col-md-8">
            <div class="widget">
              <div class="widget-body">
                <form action="signup.php" method="POST">
                  <div class="row">
                    <div class="form-group col-sm-12">
                      <label for="exampleInputEmail1">User-Name</label>
                      <input class="form-control" type="text" name="username" id="example-text-input" placeholder="UserName">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">First Name</label>
                        <input class="form-control" type="text" name="firstname" id="example-text-input" placeholder="First Name"> 
                    </div>
                          <div class="form-group col-sm-6">
                             <label for="exampleInputEmail1">Last Name</label>
                             <input class="form-control" type="text" name="lastname" id="example-text-input-2" placeholder="Last Name"> 
                          </div>
                          <div class="form-group col-sm-6">
                             <label for="exampleInputEmail1">Email address</label>
                             <input type="text" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email"> 
                          </div>
                          <div class="form-group col-sm-6">
                             <label for="exampleInputEmail1">Phone number</label>
                             <input class="form-control" type="text" name="phone" id="example-tel-input-3" placeholder="Phone"> 
                          </div>

                          
                          <div class="form-group col-sm-6" id="gender-dropdown" >
                            <label for="health-challenges">Gender</label>
                            <select id="gender" name="gender"  class="form-control col-sm-6" >
                              <option value="" selected disabled >Select Gender</option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                            </select>
                        </div>

                          <div class="form-group col-sm-6">
                             <label for="exampleInputPassword1">Password</label>
                             <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password"> <small id="emailHelp" class="form-text text-muted">Don't Share Password with anyone.</small>
                          </div>
                          <div class="form-group col-sm-6">
                             <label for="exampleInputPassword1">Repeat password</label>
                             <input type="password" class="form-control" name="cpassword" id="exampleInputPassword2" placeholder="Password"> <small id="emailHelp" class="form-text text-muted">Don't Share Password with anyone.</small>
                          </div>

                          <div class="form-group col-sm-6">
                            <label for="exampleInputEmail1">Date of Birth</label>
                            <input class="form-control" type="date" name="dob" id="example-tel-input-1"> 
                         </div>
  

                          <div id="health-dropdown" class="form-group col-sm-6">
                            <label for="healthchallenges">Health Challenges</label>
                            <select id="healthchallenges" name="healthchallenges" class="form-control col-sm-6">
                            <option value="" selected disabled>Select Health Challenge</option>
                            <option value="Type 1 Diabetes">Type 1 Diabetes</option>
                            <option value="Type 2 Diabetes">Type 2 Diabetes</option>
                            <option value="High Blood Pressure">High Blood Pressure</option>
                            <option value="Gall Stones">Gall Stones</option>
                            <option value="Kidney Stones">Kidney Stones</option>
                            <option value="Peanut Allergy">Nut Allergy</option>
                            <option value="Nutrient Deficiencies">Nutrient Deficiencies</option>
                            <option value="Celiac disease">Celiac disease</option>
                            <option value="Digestive Disorder">Digestive Disorder</option> 
                            </select>
    
                            <!-- </select>
                            <div id="diseases" class="form-group col-sm-6" style="display: none;">
                              <label for="specific-challenge"></label>
                              <select id="specific-challenge" name="specific-challenge"></select>
                               </div> -->
                         </div>
                          
                         <div class="form-group col-sm-12">
                             <label for="exampleTextarea">Delivery Address</label>
                             <textarea class="form-control" id="exampleTextarea"  name="address" rows="3"></textarea>
                          </div>
                         
                       </div>
                      
                       <div class="row">
                          <div class="col-sm-4">
                             <p> <input type="submit" value="Register" name="submit"  onclick="showOverlay()" class="btn theme-btn"> </p>
                          </div>
                       </div>
                       <!-- <p style="display: flex; justify-content: center; align-items: center;" > Already have an Account? <a style="text-decoration: none; color: #202020;" href=""> Login</a></p> -->
                       <div class="cta">Have an Account?<a href="login.php" style="color:#FC8019; text-decoration: none;"> Login</a></div>
                </form>
                 
     </div>
                 <!-- end: Widget -->
              </div>
              <!-- /REGISTER -->
           </div>
           <!-- WHY? -->
           <div class="col-md-4">
              <h4>Registration is fast, easy, and free.</h4>
              <hr>
              <!-- <img src="http://placehold.it/400x300" alt="" class="img-fluid"> -->
              <p></p>
              <!-- end:Panel -->
              <h4 class="m-t-20">Contact Customer Support</h4>
              <p> If you"re looking for more help or have a question to ask, please </p>
              <p> <a href="contact.php" class="btn theme-btn m-t-15">contact us</a> </p>
           </div>
           <!-- /WHY? -->
        </div>
     </div>

  
  </section>
  


    </main>


    <div id="overlay" class="overlay">
  <div style="padding: 30px; border-radius:10px; " class="overlay-message">
  <i class="fa fa-check-circle" style="font-size: 70px; color: green; margin:0 200px 0 0 ; "></i>
    <h2 style="font-weight: bolder; color: green;">Sign Up Successful</h2>
    <p>Redirecting to the Login<span id="countdown">5</span> seconds...</p>
   
  </div>
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


    <script src="./js/script.js"></script>
  
</body>

</html>