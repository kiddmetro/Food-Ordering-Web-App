<?php
require_once("../config/db.php");

if(isset($_POST['delete_gluten']))
{
    $id = mysqli_real_escape_string($db, $_POST['delete_gluten']);

    $query = "DELETE FROM glutens WHERE gluten_id='$id' ";
    $query_run = mysqli_query($db, $query);

    if($query_run)
    {
        $_SESSION['message'] = "gluten Deleted Successfully";
        header("Location: glutenindex.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "gluten Not Deleted";
        header("Location: glutenindex.php");
        exit(0);
    }
}

if (isset($_POST['update_gluten'])) {
    $id = mysqli_real_escape_string($db, $_POST['id']);
    $image = mysqli_real_escape_string($db, $_FILES['image']['name']);
    $category = mysqli_real_escape_string($db, $_POST['gluten_category']);
    $title = mysqli_real_escape_string($db, $_POST['gluten_title']);
    $price = mysqli_real_escape_string($db, $_POST['gluten_price']);
    $time = mysqli_real_escape_string($db, $_POST['gluten_time']);
    $description = mysqli_real_escape_string($db, $_POST['gluten_desc']);

    $query = "UPDATE glutens SET
        image='$image',
        gluten_category='$category',
        gluten_title='$title',
        gluten_price='$price',
        gluten_time='$time',
        gluten_desc='$description'
        WHERE gluten_id='$id'";

    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $_SESSION['message'] = "gluten Updated Successfully";
        header("Location: glutenindex.php");
        exit(0);
    } else {
        $_SESSION['message'] = "gluten Not Updated";
        header("Location: glutenindex.php");
        exit(0);
    }
}



?>