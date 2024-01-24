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

    <title>Customer View</title>
</head>
<body>

    <div class="container mt-5">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Customer View Details 
                            <a href="index.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['user_id']))
                        {
                            $id = mysqli_real_escape_string($db, $_GET['user_id']);
                            $query = "SELECT * FROM users WHERE user_id='$id' ";
                            $query_run = mysqli_query($db, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $user = mysqli_fetch_array($query_run);
                                ?>
                                
                                    <div class="mb-3">
                                        <label>User Name</label>
                                        <p class="form-control">
                                            <?=$user['username'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>First Name</label>
                                        <p class="form-control">
                                            <?=$user['firstname'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Last Name</label>
                                        <p class="form-control">
                                            <?=$user['lastname'];?>
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <label> Email</label>
                                        <p class="form-control">
                                            <?=$user['email'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label> Phone Number</label>
                                        <p class="form-control">
                                            <?=$user['phone'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3" >
                                        <label for="gender">Gender</label>
                                        <p class="form-control">
                                            <?=$user['gender'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3" >
                                        <label for="gender">Password</label>
                                        <p class="form-control">
                                            <?=$user['password'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3" >
                                        <label for="gender">Date of Birth</label>
                                        <p class="form-control">
                                            <?=$user['dob'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3" >
                                        <label for="gender">Health Challenges</label>
                                        <p class="form-control">
                                            <?=$user['healthchallenges'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Address</label>
                                        <p class="form-control">
                                            <?=$user['address'];?>
                                        </p>
                                    </div>

                                <?php
                            }
                            else
                            {
                                echo "<h4>No Such Id Found</h4>";
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