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

    <title>User Edit</title>
</head>
<body>
  
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>User Edit 
                            <a href="menuindex.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['user_id']))
                        {
                            $id = mysqli_real_escape_string($db, $_GET['user_id']);
                            $query = "SELECT * FROM users WHERE user_id ='$id' ";
                            $query_run = mysqli_query($db, $query);
                        
                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $user = mysqli_fetch_array($query_run);
                                ?>
                                <form action="code.php" method="POST">
                                    <input type="hidden" name="id" value="<?= $user['user_id']; ?>">
                        
                                    <div class="mb-3">
                                        <label>User Name</label>
                                        <input type="text" name="username" value="<?= $user['username']; ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>First Name</label>
                                        <input type="text" name="firstname" value="<?= $user['firstname']; ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Last Name</label>
                                        <input type="text" name="lastname" value="<?= $user['lastname']; ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="email" name="email" value="<?= $user['email']; ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Phone Number</label>
                                        <input type="text" name="phone" value="<?= $user['phone']; ?>" class="form-control">
                                    </div>
                        
                                    <div class="form-group col-sm-6" id="gender-dropdown">
                                        <label for="gender">Gender</label>
                                        <select id="gender" name="gender" class="form-control">
                                            <option value="" disabled>Select Gender</option>
                                            <option value="Male" <?= ($user['gender'] === 'Male') ? 'selected' : ''; ?>>Male</option>
                                            <option value="Female" <?= ($user['gender'] === 'Female') ? 'selected' : ''; ?>>Female</option>
                                        </select>
                                    </div>
                        
                                    <div class="mb-3">
                                        <label>Password</label>
                                        <input type="password" name="password" value="<?= $user['password']; ?>" class="form-control">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label>Date of Birth</label>
                                        <input type="date" name="dob" value="<?= $user['dob']; ?>" class="form-control">
                                    </div>
                        
                                    <div class="form-group col-sm-6">
                                        <label for="healthchallenges">Health Challenges</label>
                                        <select id="healthchallenges" name="healthchallenges" class="form-control">
                                            <option value="" disabled>Select Health Challenge</option>
                                            <option value="obesity" <?= ($user['healthchallenges'] === 'obesity') ? 'selected' : ''; ?>>Obesity</option>
                                            <option value="cardiovascular" <?= ($user['healthchallenges'] === 'cardiovascular') ? 'selected' : ''; ?>>Cardiovascular</option>
                                            <option value="kidney" <?= ($user['healthchallenges'] === 'kidney') ? 'selected' : ''; ?>>Kidney</option>
                                            <option value="diabetes" <?= ($user['healthchallenges'] === 'diabetes') ? 'selected' : ''; ?>>Diabetes</option>
                                            <option value="tooth-decay" <?= ($user['healthchallenges'] === 'tooth-decay') ? 'selected' : ''; ?>>Tooth Decay</option>
                                        </select>
                                    </div>
                        
                                    <div class="mb-3">
                                        <label>Address</label>
                                        <input type="text" name="address" value="<?= $user['address']; ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" name="update_user" class="btn btn-primary">
                                            Update User
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