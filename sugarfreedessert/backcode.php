<?php
require_once("./config/db.php");

if(isset($_POST['delete_sugardessert']))
{
    $id = mysqli_real_escape_string($db, $_POST['delete_sugardessert']);

    $query = "DELETE FROM sugardesserts WHERE sugardessert_id='$id' ";
    $query_run = mysqli_query($db, $query);

    if($query_run)
    {
        $_SESSION['message'] = "sugardessert Deleted Successfully";
        header("Location: sugardessertindex.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "sugardessert Not Deleted";
        header("Location: sugardessertindex.php");
        exit(0);
    }
}

if (isset($_POST['update_sugardessert'])) {
    $id = mysqli_real_escape_string($db, $_POST['id']);
    $image = mysqli_real_escape_string($db, $_FILES['image']['name']);
    $category = mysqli_real_escape_string($db, $_POST['sugardessert_category']);
    $title = mysqli_real_escape_string($db, $_POST['sugardessert_title']);
    $price = mysqli_real_escape_string($db, $_POST['sugardessert_price']);
    $time = mysqli_real_escape_string($db, $_POST['sugardessert_time']);
    $description = mysqli_real_escape_string($db, $_POST['sugardessert_desc']);

    $query = "UPDATE sugardesserts SET
        image='$image',
        sugardessert_category='$category',
        sugardessert_title='$title',
        sugardessert_price='$price',
        sugardessert_time='$time',
        sugardessert_desc='$description'
        WHERE sugardessert_id='$id'";

    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $_SESSION['message'] = "sugardessert Updated Successfully";
        header("Location: sugardessertindex.php");
        exit(0);
    } else {
        $_SESSION['message'] = "sugardessert Not Updated";
        header("Location: sugardessertindex.php");
        exit(0);
    }
}



?>