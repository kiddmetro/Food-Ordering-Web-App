<?php
require_once("../config/db.php");

if(isset($_POST['delete_nondairy']))
{
    $id = mysqli_real_escape_string($db, $_POST['delete_nondairy']);

    $query = "DELETE FROM nondairys WHERE nondairy_id='$id' ";
    $query_run = mysqli_query($db, $query);

    if($query_run)
    {
        $_SESSION['message'] = "nondairy Deleted Successfully";
        header("Location: nondairyindex.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "nondairy Not Deleted";
        header("Location: nondairyindex.php");
        exit(0);
    }
}

if (isset($_POST['update_nondairy'])) {
    $id = mysqli_real_escape_string($db, $_POST['id']);
    $image = mysqli_real_escape_string($db, $_FILES['image']['name']);
    $category = mysqli_real_escape_string($db, $_POST['nondairy_category']);
    $title = mysqli_real_escape_string($db, $_POST['nondairy_title']);
    $price = mysqli_real_escape_string($db, $_POST['nondairy_price']);
    $time = mysqli_real_escape_string($db, $_POST['nondairy_time']);
    $description = mysqli_real_escape_string($db, $_POST['nondairy_desc']);

    $query = "UPDATE nondairys SET
        image='$image',
        nondairy_category='$category',
        nondairy_title='$title',
        nondairy_price='$price',
        nondairy_time='$time',
        nondairy_desc='$description'
        WHERE nondairy_id='$id'";

    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $_SESSION['message'] = "Nondairy Updated Successfully";
        header("Location: nondairyindex.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Nondairy Not Updated";
        header("Location: nondairyindex.php");
        exit(0);
    }
}



?>