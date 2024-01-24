<?php
require_once("../config/db.php");

if(isset($_POST['delete_popular']))
{
    $id = mysqli_real_escape_string($db, $_POST['delete_popular']);

    $query = "DELETE FROM populars WHERE popular_id='$id' ";
    $query_run = mysqli_query($db, $query);

    if($query_run)
    {
        $_SESSION['message'] = "popular Deleted Successfully";
        header("Location: popularindex.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "popular Not Deleted";
        header("Location: popularindex.php");
        exit(0);
    }
}

if (isset($_POST['update_popular'])) {
    $id = mysqli_real_escape_string($db, $_POST['id']);
    $image = mysqli_real_escape_string($db, $_FILES['image']['name']);
    $category = mysqli_real_escape_string($db, $_POST['dish_category']);
    $title = mysqli_real_escape_string($db, $_POST['dish_title']);
    $price = mysqli_real_escape_string($db, $_POST['dish_price']);
    $time = mysqli_real_escape_string($db, $_POST['dish_time']);
    $description = mysqli_real_escape_string($db, $_POST['dish_desc']);

    $query = "UPDATE populars SET
        image='$image',
        dish_category='$category',
        dish_title='$title',
        dish_price='$price',
        dish_time='$time',
        dish_desc='$description'
        WHERE popular_id='$id'";

    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $_SESSION['message'] = "popular Updated Successfully";
        header("Location: popularindex.php");
        exit(0);
    } else {
        $_SESSION['message'] = "popular Not Updated";
        header("Location: popularindex.php");
        exit(0);
    }
}



?>