<?php
require_once("./config/db.php");

if(isset($_POST['delete_vegan']))
{
    $id = mysqli_real_escape_string($db, $_POST['delete_vegan']);

    $query = "DELETE FROM vegans WHERE vegan_id='$id' ";
    $query_run = mysqli_query($db, $query);

    if($query_run)
    {
        $_SESSION['message'] = "vegan Deleted Successfully";
        header("Location: veganindex.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "vegan Not Deleted";
        header("Location: veganindex.php");
        exit(0);
    }
}

if (isset($_POST['update_vegan'])) {
    $id = mysqli_real_escape_string($db, $_POST['id']);
    $image = mysqli_real_escape_string($db, $_FILES['image']['name']);
    $category = mysqli_real_escape_string($db, $_POST['vegan_category']);
    $title = mysqli_real_escape_string($db, $_POST['vegan_title']);
    $price = mysqli_real_escape_string($db, $_POST['vegan_price']);
    $time = mysqli_real_escape_string($db, $_POST['vegan_time']);
    $description = mysqli_real_escape_string($db, $_POST['vegan_desc']);

    $query = "UPDATE vegans SET
        image='$image',
        vegan_category='$category',
        vegan_title='$title',
        vegan_price='$price',
        vegan_time='$time',
        vegan_desc='$description'
        WHERE vegan_id='$id'";

    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $_SESSION['message'] = "vegan Updated Successfully";
        header("Location: veganindex.php");
        exit(0);
    } else {
        $_SESSION['message'] = "vegan Not Updated";
        header("Location: veganindex.php");
        exit(0);
    }
}



?>