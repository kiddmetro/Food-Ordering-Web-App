<?php
require_once("../config/db.php");

if(isset($_POST['delete_category']))
{
    $id = mysqli_real_escape_string($db, $_POST['delete_category']);

    $query = "DELETE FROM categorys WHERE category_id='$id' ";
    $query_run = mysqli_query($db, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Category Deleted Successfully";
        header("Location: categoryindex.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Category Not Deleted";
        header("Location: categoryindex.php");
        exit(0);
    }
}

if (isset($_POST['update_category'])) {
    $id = mysqli_real_escape_string($db, $_POST['id']);
    $image = mysqli_real_escape_string($db, $_FILES['image']['name']);
    $title = mysqli_real_escape_string($db, $_POST['category_title']);
    $description = mysqli_real_escape_string($db, $_POST['category_desc']);

    $query = "UPDATE categorys SET
        image='$image',
        category_title='$title',
        category_desc='$description'
        WHERE category_id='$id'";

    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $_SESSION['message'] = "Category Updated Successfully";
        header("Location: categoryindex.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Category Not Updated";
        header("Location: categoryindex.php");
        exit(0);
    }
}



?>