<?php
require_once("./config/db.php");

if(isset($_POST['delete_salad']))
{
    $id = mysqli_real_escape_string($db, $_POST['delete_salad']);

    $query = "DELETE FROM salads WHERE salad_id='$id' ";
    $query_run = mysqli_query($db, $query);

    if($query_run)
    {
        $_SESSION['message'] = "salad Deleted Successfully";
        header("Location: saladindex.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "salad Not Deleted";
        header("Location: saladindex.php");
        exit(0);
    }
}

if (isset($_POST['update_salad'])) {
    $id = mysqli_real_escape_string($db, $_POST['id']);
    $image = mysqli_real_escape_string($db, $_FILES['image']['name']);
    $category = mysqli_real_escape_string($db, $_POST['salad_category']);
    $title = mysqli_real_escape_string($db, $_POST['salad_title']);
    $price = mysqli_real_escape_string($db, $_POST['salad_price']);
    $time = mysqli_real_escape_string($db, $_POST['salad_time']);
    $description = mysqli_real_escape_string($db, $_POST['salad_desc']);

    $query = "UPDATE salads SET
        image='$image',
        salad_category='$category',
        salad_title='$title',
        salad_price='$price',
        salad_time='$time',
        salad_desc='$description'
        WHERE salad_id='$id'";

    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $_SESSION['message'] = "salad Updated Successfully";
        header("Location: healthysaladindex.php");
        exit(0);
    } else {
        $_SESSION['message'] = "salad Not Updated";
        header("Location: healthysaladindex.php");
        exit(0);
    }
}



?>