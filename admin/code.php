<?php
require_once("../config/db.php");

if(isset($_POST['delete_user']))
{
    $id = mysqli_real_escape_string($db, $_POST['delete_user']);

    $query = "DELETE FROM users WHERE user_id='$id' ";
    $query_run = mysqli_query($db, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Student Deleted Successfully";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Deleted";
        header("Location: index.php");
        exit(0);
    }
}

    if(isset($_POST['update_user']))
    {
        $id = mysqli_real_escape_string($db, $_POST['id']);
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $firstname =  mysqli_real_escape_string($db, $_POST['firstname']);
        $lastname =  mysqli_real_escape_string($db, $_POST['lastname']);
        $email =  mysqli_real_escape_string($db, $_POST['email']);
        $phone =  mysqli_real_escape_string($db, $_POST['phone']);
        $password =  mysqli_real_escape_string($db, $_POST['password']);
        $dob =  mysqli_real_escape_string($db, $_POST['dob']);
        $address =  mysqli_real_escape_string($db, $_POST['address']);

        $query =  "UPDATE users SET
        username='$username',
        firstname='$firstname',
        lastname='$lastname',
        email='$email',
        phone='$phone',
        password='$password',
        dob='$dob',
        address='$address'
      WHERE user_id='$id'";
         $query_run = mysqli_query($db, $query);

         if($query_run)
             {
                $_SESSION['message'] = "Student Updated Successfully";
                header("Location: index.php");
                exit(0);
                }
            else
             {
                 $_SESSION['message'] = "Student Not Updated";
                header("Location: index.php");
                exit(0);
             }

}




?>