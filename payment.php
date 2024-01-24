<?php

require_once("./config/db.php");
require_once("./config/function.php");

$userdata = check_login($db);

// Establish a database connection using PDO
try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit();
}

// Define variables to hold form input values and error messages
$fullname = $phone = $email = $address = $cardname = $cardnumber = $expmonth = $expyear = $cvv = "";
$fullnameErr = $phoneErr = $emailErr = $addressErr = $cardnameErr = $cardnumberErr = $expmonthErr = $expyearErr = $cvvErr = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['place_order'])) {
        // Validate and sanitize the input fields

        // Full Name
        if (empty($_POST['fullname'])) {
            $fullnameErr = "Full name is required";
        } else {
            $fullname = sanitizeInput($_POST['fullname']);
        }

        // Phone Number
        if (empty($_POST['phone'])) {
            $phoneErr = "Phone number is required";
        } else {
            $phone = sanitizeInput($_POST['phone']);
        }

        // Email
        if (empty($_POST['email'])) {
            $emailErr = "Email is required";
        } else {
            $email = sanitizeInput($_POST['email']);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }

        // Address
        if (empty($_POST['address'])) {
            $addressErr = "Address is required";
        } else {
            $address = sanitizeInput($_POST['address']);
        }

        // Card Name
        if (empty($_POST['cardname'])) {
            $cardnameErr = "Name on card is required";
        } else {
            $cardname = sanitizeInput($_POST['cardname']);
        }

        // Card Number
        if (empty($_POST['cardnumber'])) {
            $cardnumberErr = "Credit card number is required";
        } else {
            $cardnumber = sanitizeInput($_POST['cardnumber']);
        }

        // Expiration Month
        if (empty($_POST['expmonth'])) {
            $expmonthErr = "Expiration month is required";
        } else {
            $expmonth = sanitizeInput($_POST['expmonth']);
        }

        // Expiration Year
        if (empty($_POST['expyear'])) {
            $expyearErr = "Expiration year is required";
        } else {
            $expyear = sanitizeInput($_POST['expyear']);
        }

        // CVV
        if (empty($_POST['cvv'])) {
            $cvvErr = "CVV is required";
        } else {
            $cvv = sanitizeInput($_POST['cvv']);
        }

        // Check if all the input fields are valid
        if (empty($fullnameErr) && empty($phoneErr) && empty($emailErr) && empty($addressErr) && empty($cardnameErr) && empty($cardnumberErr) && empty($expmonthErr) && empty($expyearErr) && empty($cvvErr)) {
            // Check if the 'user_id' index is set in the $_SESSION array
            if (isset($_SESSION['user_id'])) {
                $userId = $_SESSION['user_id'];

                // Fetch user details from the `users` table
                $userQuery = "SELECT username, firstname, lastname, phone, email, healthchallenges, address FROM `users` WHERE user_id = ?";
                $userStmt = $pdo->prepare($userQuery);
                $userStmt->execute([$userId]);
                $user = $userStmt->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                    $username = $user['username'];
                    $firstname = $user['firstname'];
                    $lastname = $user['lastname'];
                    $phone = $user['phone'];
                    $email = $user['email'];
                    $healthchallenges = $user['healthchallenges'];
                    $address = $user['address'];

                    // Calculate the total amount based on the items in the shopping cart
                    $totalAmount = 0;
                    foreach ($_SESSION['shopping-cart'] as $dish) {
                        $price = $dish['dish_price'];
                        $totalAmount += $price;
                    }

                    // Insert the order details into the `orders` table
                    $insertOrderQuery = "INSERT INTO `orders` (user_id, total_amount, username, firstname, lastname, phone, email, healthchallenges, address) 
                                         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $orderStmt = $pdo->prepare($insertOrderQuery);

                    // Provide the user ID obtained from the session
                    $orderStmt->execute([$userId, $totalAmount, $username, $firstname, $lastname, $phone, $email, $healthchallenges, $address]);

                    // Retrieve the auto-generated order ID
                    $orderId = $pdo->lastInsertId();

                    // Insert the order items into the `order_item` table
                    $insertOrderItemQuery = "INSERT INTO `order_item` (order_id, dish_id, dish_category, dish_portion, dish_title, price) 
                                            VALUES (?, ?, ?, ?, ?, ?)";

                    $orderItemStmt = $pdo->prepare($insertOrderItemQuery);

                    foreach ($_SESSION['shopping-cart'] as $dish) {
                        $dishId = $dish['dish_id'];
                        $dishCategory = $dish['dish_category'];
                        $dishPortion = isset($dish['dish_portion']) ? $dish['dish_portion'] : '';
                        $dishTitle = $dish['dish_title'];
                        $price = $dish['dish_price'];

                        $orderItemStmt->execute([$orderId, $dishId, $dishCategory, $dishPortion, $dishTitle, $price]);

                    }

                    // Clear the shopping cart after placing the order
                    $_SESSION['shopping-cart'] = [];

                    // Redirect to a confirmation page or any other desired page
                    header("Location: ./order.php");
                    exit();
                } else {
                    // Redirect the user to the login page if the user details are not found
                    header("Location: ./login.php");
                    exit();
                }
            } else {
                // Redirect the user to the login page if they are not logged in
                header("Location: ./login.php");
                exit();
            }
        }
    }
}

// Function to sanitize input values
function sanitizeInput($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/payment.css">
    
    <style>
        .error {
            color: red;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
        }

        .overlay-message {
            background-color: white;
            padding: 30px;
            border-radius: 5px;
        }
    </style>

</head>
<body>

<div class="container">

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

        <div class="row">

            <div class="col">

                <h3 class="title">billing address</h3>

                <div class="inputBox">
                    <span>full name :</span>
                    <input type="text" name="fullname" placeholder="John Doe" value="<?php echo $fullname; ?>">
                    <span class="error"><?php echo $fullnameErr; ?></span>
                </div>
                <div class="inputBox">
                    <span>phone no :</span>
                    <input type="text" name="phone" placeholder="08145323575" value="<?php echo $phone; ?>">
                    <span class="error"><?php echo $phoneErr; ?></span>
                </div>
                <div class="inputBox">
                    <span>email :</span>
                    <input type="email" name="email" placeholder="example@example.com" value="<?php echo $email; ?>">
                    <span class="error"><?php echo $emailErr; ?></span>
                </div>
                <div class="inputBox">
                    <span>address :</span>
                    <input type="text" name="address" placeholder="Room - Street - Locality" value="<?php echo $address; ?>">
                    <span class="error"><?php echo $addressErr; ?></span>
                </div>

            </div>

            <div class="col">

                <h3 class="title">payment</h3>

                <div class="inputBox">
                    <span>cards accepted :</span>
                    <img src="images/card_img.png" alt="">
                </div>
                <div class="inputBox">
                    <span>name on card :</span>
                    <input type="text" name="cardname" placeholder="Mr. John Doe" value="<?php echo $cardname; ?>">
                    <span class="error"><?php echo $cardnameErr; ?></span>
                </div>
                <div class="inputBox">
                    <span>credit card number :</span>
                    <input type="number" name="cardnumber" placeholder="1111-2222-3333-4444" value="<?php echo $cardnumber; ?>">
                    <span class="error"><?php echo $cardnumberErr; ?></span>
                </div>
                <div class="inputBox">
                    <span>exp month :</span>
                    <input type="text" name="expmonth" placeholder="January" value="<?php echo $expmonth; ?>">
                    <span class="error"><?php echo $expmonthErr; ?></span>
                </div>

                <div class="flex">
                    <div class="inputBox">
                        <span>exp year :</span>
                        <input type="number" name="expyear" placeholder="2022" value="<?php echo $expyear; ?>">
                        <span class="error"><?php echo $expyearErr; ?></span>
                    </div>
                    <div class="inputBox">
                        <span>CVV :</span>
                        <input type="text" name="cvv" placeholder="123" value="<?php echo $cvv; ?>">
                        <span class="error"><?php echo $cvvErr; ?></span>
                    </div>
                </div>

            </div>
    
        </div>

        <input type="submit" name="place_order" value="proceed to checkout" class="submit-btn" onclick="showOverlay()">

    </form>

</div>   

<div id="overlay" class="overlay">
    <div class="overlay-message">
        <h2 style="font-weight: bolder; color: green;" >Payment Made and Order Received</h2>
        <p>Redirecting to the order page in <span id="countdown">5</span> seconds...</p>
    </div>
</div> 
    

<script>
    function showOverlay() {
        var overlay = document.getElementById("overlay");
        overlay.style.display = "flex";

        var countdownElement = document.getElementById("countdown");
        var countdown = 5;

        var timer = setInterval(function() {
            countdown--;
            countdownElement.innerText = countdown;

            if (countdown <= 0) {
                clearInterval(timer);
                window.location.href = "order.php";
            }
        }, 1000);
    }
</script>
    
</body>
</html>
