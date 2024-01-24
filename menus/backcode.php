<?php
require_once("../config/db.php");

if(isset($_POST['delete_menu']))
{
    $id = mysqli_real_escape_string($db, $_POST['delete_menu']);

    $query = "DELETE FROM menus WHERE menu_id='$id' ";
    $query_run = mysqli_query($db, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Menu Deleted Successfully";
        header("Location: menuindex.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Menu Not Deleted";
        header("Location: menuindex.php");
        exit(0);
    }
}

if (isset($_POST['update_menu'])) {
    $id = mysqli_real_escape_string($db, $_POST['id']);
    $image = mysqli_real_escape_string($db, $_FILES['image']['name']);
    $category = mysqli_real_escape_string($db, $_POST['dish_category']);
    $title = mysqli_real_escape_string($db, $_POST['dish_title']);
    $price = mysqli_real_escape_string($db, $_POST['dish_price']);
    $time = mysqli_real_escape_string($db, $_POST['dish_time']);
    $description = mysqli_real_escape_string($db, $_POST['dish_desc']);

    $query = "UPDATE menus SET
        image='$image',
        dish_category='$category',
        dish_title='$title',
        dish_price='$price',
        dish_time='$time',
        dish_desc='$description'
        WHERE menu_id='$id'";

    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $_SESSION['message'] = "Menu Updated Successfully";
        header("Location: menuindex.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Menu Not Updated";
        header("Location: menuindex.php");
        exit(0);
    }
}



?>